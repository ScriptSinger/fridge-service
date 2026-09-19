<?php

namespace Tests\Feature;

use App\Jobs\SendEmailLeadNotification;
use App\Jobs\SendTelegramLeadNotification;
use App\Mail\NewLeadMail;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class LeadSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_is_saved_and_telegram_notification_is_queued(): void
    {
        Queue::fake();

        $response = $this->postJson('/api/leads', [
            'name' => 'Иван',
            'phone' => '+7 (999) 123-45-67',
            'comment' => 'Нужен ремонт.',
            'intent' => 'consultation',
            'privacy_policy' => true,
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('success', true);

        $leadId = $response->json('id');

        $this->assertDatabaseHas('leads', [
            'id' => $leadId,
            'name' => 'Иван',
            'phone' => '+7 (999) 123-45-67',
            'status' => 'new',
            'channel' => 'form',
            'intent' => 'consultation',
        ]);

        Queue::assertPushed(
            SendTelegramLeadNotification::class,
            fn (SendTelegramLeadNotification $job) => $job->leadId === $leadId,
        );

        Queue::assertPushed(
            SendEmailLeadNotification::class,
            fn (SendEmailLeadNotification $job) => $job->leadId === $leadId,
        );
    }

    public function test_worker_sends_queued_lead_to_telegram(): void
    {
        config([
            'services.telegram.bot_token' => 'test-token',
            'services.telegram.chat_id' => '123456',
            'services.telegram.proxy' => null,
        ]);
        Http::fake([
            'https://api.telegram.org/*' => Http::response(['ok' => true]),
        ]);

        $lead = Lead::create([
            'name' => 'Иван',
            'phone' => '+7 (999) 123-45-67',
            'channel' => 'form',
            'intent' => 'repair',
        ]);

        (new SendTelegramLeadNotification($lead->id))->handle();

        Http::assertSent(fn (Request $request) => $request->url() === 'https://api.telegram.org/bottest-token/sendMessage'
            && $request['chat_id'] === '123456'
            && str_contains($request['text'], $lead->phone)
            && str_contains($request['text'], 'Заказать ремонт')
        );
    }

    public function test_worker_sends_queued_lead_by_email(): void
    {
        config(['services.lead_notification.email' => 'lucky2strike@yandex.ru']);
        Mail::fake();

        $lead = Lead::create([
            'name' => 'Иван',
            'phone' => '+7 (999) 123-45-67',
        ]);

        (new SendEmailLeadNotification($lead->id))->handle();

        Mail::assertSent(
            NewLeadMail::class,
            fn (NewLeadMail $mail) => $mail->hasTo('lucky2strike@yandex.ru') && $mail->lead->is($lead),
        );
    }

    public function test_email_shows_the_channel_and_intent_when_set(): void
    {
        $lead = Lead::create([
            'name' => 'Иван',
            'phone' => '+7 (999) 123-45-67',
            'channel' => 'form',
            'intent' => 'consultation',
        ]);

        $html = (new NewLeadMail($lead))->render();

        $this->assertStringContainsString('Форма', $html);
        $this->assertStringContainsString('Получить консультацию', $html);
    }

    public function test_email_omits_the_intent_line_when_not_set(): void
    {
        $lead = Lead::create([
            'name' => 'Иван',
            'phone' => '+7 (999) 123-45-67',
            'channel' => 'phone',
        ]);

        $html = (new NewLeadMail($lead))->render();

        $this->assertStringContainsString('Звонок', $html);
        $this->assertStringNotContainsString('Цель:', $html);
    }
}
