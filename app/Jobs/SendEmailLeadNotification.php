<?php

namespace App\Jobs;

use App\Mail\NewLeadMail;
use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RuntimeException;
use Throwable;

class SendEmailLeadNotification implements ShouldQueue
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
            Log::warning('Email lead notification skipped: lead not found', [
                'lead_id' => $this->leadId,
            ]);

            return;
        }

        $email = (string) config('services.lead_notification.email');

        if ($email === '') {
            throw new RuntimeException('Lead notification email is not configured.');
        }

        Mail::to($email)->send(new NewLeadMail($lead));

        Log::info('Email lead notification sent', [
            'lead_id' => $lead->id,
            'email' => $email,
        ]);
    }

    public function failed(Throwable $exception): void
    {
        Log::error('Email lead notification failed after retries', [
            'lead_id' => $this->leadId,
            'exception' => $exception->getMessage(),
        ]);
    }
}
