<?php

namespace App\Jobs;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

class SendTelegramLeadNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public array $backoff = [60, 300, 900];

    public int $timeout = 20;

    public function __construct(public readonly int $leadId) {}

    public function handle(): void
    {
        $lead = Lead::find($this->leadId);

        if (! $lead) {
            Log::warning('Telegram lead notification skipped: lead not found', [
                'lead_id' => $this->leadId,
            ]);

            return;
        }

        $token = (string) config('services.telegram.bot_token');
        $chatId = (string) config('services.telegram.chat_id');
        $proxy = config('services.telegram.proxy');

        if ($token === '' || $chatId === '') {
            throw new RuntimeException('Telegram notification is not configured.');
        }

        $message = "Новый лид!\n";
        $message .= 'Имя: '.($lead->name ?? '—')."\n";
        $message .= 'Телефон: '.($lead->phone ?? '—')."\n";
        $message .= 'Источник: '.($lead->leadable_type ?? '—');

        $response = Http::withOptions($proxy ? ['proxy' => $proxy] : [])
            ->connectTimeout(5)
            ->timeout(15)
            ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
            ]);

        $response->throw();

        Log::info('Telegram lead notification sent', [
            'lead_id' => $lead->id,
            'telegram_status' => $response->status(),
        ]);
    }

    public function failed(Throwable $exception): void
    {
        Log::error('Telegram lead notification failed after retries', [
            'lead_id' => $this->leadId,
            'exception' => $exception->getMessage(),
        ]);
    }
}
