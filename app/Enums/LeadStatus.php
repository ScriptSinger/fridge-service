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

    public function toString(): string
    {
        return match ($this) {
            self::New => 'Новая',
            self::InProgress => 'В работе',
            self::Scheduled => 'Назначен выезд',
            self::Closed => 'Закрыта',
            self::Declined => 'Отказ',
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
        };
    }
}
