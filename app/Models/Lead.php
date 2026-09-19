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

    // Only meaningful when channel = form — the two lead-form usages
    // (modal "Заказать ремонт" vs the contact-section "Получить
    // консультацию") share the same component/endpoint, so without this
    // nobody could tell which one a client actually submitted.
    public const INTENT_REPAIR = 'repair';
    public const INTENT_CONSULTATION = 'consultation';

    public const INTENTS = [
        self::INTENT_REPAIR,
        self::INTENT_CONSULTATION,
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
        'intent',
        'status',
        'utm_source',
        'utm_medium',
        'utm_campaign',
    ];

    public function leadable()
    {
        return $this->morphTo();
    }

    /**
     * Human-readable labels for notifications (Telegram/email) — kept here
     * rather than reusing LeadResource's option maps, since a queued Job/Mail
     * pulling in a MoonShine admin resource class would be a backwards
     * dependency.
     */
    public function getChannelLabelAttribute(): string
    {
        return match ($this->channel) {
            self::CHANNEL_FORM => 'Форма',
            self::CHANNEL_PHONE => 'Звонок',
            self::CHANNEL_WHATSAPP => 'WhatsApp',
            self::CHANNEL_TELEGRAM => 'Telegram',
            self::CHANNEL_VK => 'ВКонтакте',
            default => $this->channel ?? '—',
        };
    }

    public function getIntentLabelAttribute(): ?string
    {
        return match ($this->intent) {
            self::INTENT_REPAIR => 'Заказать ремонт',
            self::INTENT_CONSULTATION => 'Получить консультацию',
            default => null,
        };
    }
}
