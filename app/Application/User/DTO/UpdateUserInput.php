<?php

declare(strict_types=1);

namespace App\Application\User\DTO;

use App\Domain\User\ValueObject\UserRole;

final class UpdateUserInput
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly UserRole $role,
        public readonly ?string $password = null,
    ) {}
}
