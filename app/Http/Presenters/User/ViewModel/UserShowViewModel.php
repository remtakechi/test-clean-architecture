<?php

declare(strict_types=1);

namespace App\Http\Presenters\User\ViewModel;

final class UserShowViewModel
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $role_label,
        public readonly bool $is_admin,
        public readonly string $created_at,
        public readonly string $updated_at,
    ) {}
}
