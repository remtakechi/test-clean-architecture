<?php

declare(strict_types=1);

namespace App\Application\User\DTO;

use App\Domain\User\Entity\UserEntity;
use App\Domain\User\ValueObject\UserRole;

final class UserOutput
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly UserRole $role,
        public readonly string $role_label,
        public readonly ?\DateTimeImmutable $created_at,
        public readonly ?\DateTimeImmutable $updated_at,
    ) {
    }

    public static function fromEntity(UserEntity $entity): self
    {
        return new self(
            id: $entity->id,
            name: $entity->name,
            email: $entity->email,
            role: $entity->role,
            role_label: $entity->role->label(),
            created_at: $entity->created_at,
            updated_at: $entity->updated_at,
        );
    }
}
