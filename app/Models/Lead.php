<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public const CHANNEL_FORM = 'form';
    public const CHANNEL_PHONE = 'phone';
    public const CHANNEL_WHATSAPP = 'whatsapp';
    public const CHANNEL_TELEGRAM = 'telegram';
    public const CHANNEL_VK = 'vk';

    public const CHANNELS = [
        self::CHANNEL_FORM,
        self::CHANNEL_PHONE,
        self::CHANNEL_WHATSAPP,
        self::CHANNEL_TELEGRAM,
        self::CHANNEL_VK,
    ];

    protected $casts = [
        'status' => LeadStatus::class,
    ];

    protected static function booted(): void
    {
        // Not mass-assignable on purpose — a client posting the form/click
        // request must never be able to spoof these by including them in the
        // request body, only the server's own view of the request counts.
        static::creating(function (Lead $lead) {
            $lead->ip_address = request()->ip();
            $lead->user_agent = request()->userAgent();
        });
    }

    protected $fillable = [
        'name',
        'phone',
        'comment',
        'channel',
        'status',
        'utm_source',
        'utm_medium',
        'utm_campaign',
    ];

    public function leadable()
    {
        return $this->morphTo();
    }
}
