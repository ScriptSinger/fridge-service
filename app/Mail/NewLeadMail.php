<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewLeadMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Lead $lead) {}

    public function build(): self
    {
        return $this
            ->subject('Новый лид: '.($this->lead->name ?? 'без имени'))
            ->view('emails.leads.new');
    }
}
