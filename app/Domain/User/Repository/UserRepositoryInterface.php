<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\UserEntity;

interface UserRepositoryInterface
{
    public function findById(int $id): ?UserEntity;

    /** @return UserEntity[] */
    public function findAll(): array;

    public function emailExists(string $email, ?int $excludeId = null): bool;

    public function create(UserEntity $user): UserEntity;

    public function update(UserEntity $user): UserEntity;

    public function delete(int $id): void;
}
