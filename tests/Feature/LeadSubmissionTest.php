<?php

namespace Tests\Feature;

use App\Jobs\SendTelegramLeadNotification;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
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
        ]);

        Queue::assertPushed(
            SendTelegramLeadNotification::class,
            fn (SendTelegramLeadNotification $job) => $job->leadId === $leadId,
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
        ]);

        (new SendTelegramLeadNotification($lead->id))->handle();

        Http::assertSent(fn (Request $request) => $request->url() === 'https://api.telegram.org/bottest-token/sendMessage'
            && $request['chat_id'] === '123456'
            && str_contains($request['text'], $lead->phone)
        );
    }
}
