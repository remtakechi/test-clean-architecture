<?php

declare(strict_types=1);

namespace App\Application\User\DTO;

use App\Domain\User\ValueObject\UserRole;

final class CreateUserInput
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly UserRole $role,
    ) {
    }
}
