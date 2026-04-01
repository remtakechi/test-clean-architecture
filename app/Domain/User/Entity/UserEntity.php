<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use App\Domain\User\ValueObject\UserRole;

final class UserEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password,
        public readonly UserRole $role,
        public readonly ?\DateTimeImmutable $created_at,
        public readonly ?\DateTimeImmutable $updated_at,
    ) {
    }

    public static function create(
        string $name,
        string $email,
        string $password,
        UserRole $role = UserRole::Member,
    ): self {
        return new self(
            id: null,
            name: $name,
            email: $email,
            password: $password,
            role: $role,
            created_at: null,
            updated_at: null,
        );
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    public function withUpdatedFields(string $name, string $email, UserRole $role): self
    {
        return new self(
            id: $this->id,
            name: $name,
            email: $email,
            password: $this->password,
            role: $role,
            created_at: $this->created_at,
            updated_at: $this->updated_at,
        );
    }

    public function withPassword(string $password): self
    {
        return new self(
            id: $this->id,
            name: $this->name,
            email: $this->email,
            password: $password,
            role: $this->role,
            created_at: $this->created_at,
            updated_at: $this->updated_at,
        );
    }
}
