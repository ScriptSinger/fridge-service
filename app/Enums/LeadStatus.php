<?php

namespace App\Enums;

use MoonShine\Support\Enums\Color;

/**
 * A real backed enum (rather than string constants on Lead) so MoonShine's
 * Enum field can render it as a colored badge automatically — its Select
 * field only badges multi-select values, a single status needs an attached
 * enum with getColor()/toString() for MoonShine to pick up on it.
 */
enum LeadStatus: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Scheduled = 'scheduled';
    case Closed = 'closed';
    case Declined = 'declined';
    // Catch-all for anything that never was a real opportunity: caller from
    // another city outside the service area, an accidental click that never
    // turned into an actual call/message, a wrong number, etc. — distinct
    // from Declined, which means real contact was made and they said no.
    // Kept as one general status rather than a status per reason, since new
    // reasons will keep coming up and the funnel only cares that it's
    // excluded from real stats, not why.
    case Irrelevant = 'irrelevant';

    public function toString(): string
    {
        return match ($this) {
            self::New => 'Новая',
            self::InProgress => 'В работе',
            self::Scheduled => 'Назначен выезд',
            self::Closed => 'Закрыта',
            self::Declined => 'Отказ',
            self::Irrelevant => 'Нерелевантная',
        };
    }

    public function getColor(): Color
    {
        return match ($this) {
            self::New => Color::WARNING,
            self::InProgress => Color::INFO,
            self::Scheduled => Color::PRIMARY,
            self::Closed => Color::SUCCESS,
            self::Declined => Color::ERROR,
            self::Irrelevant => Color::GRAY,
        };
    }

    /**
     * Excluded from lead-volume stats (dashboard counts, funnel metrics) —
     * it was never a real opportunity in the first place.
     */
    public function countsTowardStats(): bool
    {
        return $this !== self::Irrelevant;
    }
}
