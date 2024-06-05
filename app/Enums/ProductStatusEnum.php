<?php

namespace App\Enums;

enum ProductStatusEnum: string
{
    case DRAFT = 'draft';
    case ACTIVE = 'active';
    case ARCHIVED = 'archived';

    public static function getValues(): array
    {
        return [
            self::DRAFT->value,
            self::ACTIVE->value,
            self::ARCHIVED->value
        ];
    }
}
