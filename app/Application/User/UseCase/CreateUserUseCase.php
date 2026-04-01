<?php

declare(strict_types=1);

namespace App\Application\User\UseCase;

use App\Application\User\DTO\CreateUserInput;
use App\Application\User\DTO\UserOutput;
use App\Application\User\Exception\DuplicateEmailApplicationException;
use App\Application\Service\PasswordHasherInterface;
use App\Domain\User\Entity\UserEntity;
use App\Domain\User\Repository\UserRepositoryInterface;

final class CreateUserUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
        private readonly PasswordHasherInterface $hasher,
    ) {}

    public function handle(CreateUserInput $input): UserOutput
    {
        if ($this->repository->emailExists($input->email)) {
            throw new DuplicateEmailApplicationException();
        }

        $entity = UserEntity::create(
            name: $input->name,
            email: $input->email,
            password: $this->hasher->hash($input->password),
            role: $input->role,
        );

        $created = $this->repository->create($entity);

        return UserOutput::fromEntity($created);
    }
}
