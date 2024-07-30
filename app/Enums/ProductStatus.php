<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProductStatus: string implements HasColor, HasLabel
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case DISCONTINUED = 'discontinued';
    case WAITING_APPROVAL = 'waiting-approval';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::DISCONTINUED => 'Discontinued',
            self::WAITING_APPROVAL => 'Waiting approval',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::ACTIVE => 'success',
            self::INACTIVE => 'gray',
            self::DISCONTINUED => 'gray',
            self::WAITING_APPROVAL => 'warning',
        };
    }
}
