<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

enum UserRole: string
{
    case Admin = 'admin';
    case Member = 'member';

    public function label(): string
    {
        return match ($this) {
            UserRole::Admin => 'Admin',
            UserRole::Member => 'Member',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
