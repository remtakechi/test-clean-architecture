<?php

declare(strict_types=1);

namespace App\Application\User\UseCase;

use App\Application\User\DTO\UpdateUserInput;
use App\Application\User\DTO\UserOutput;
use App\Application\User\Exception\DuplicateEmailApplicationException;
use App\Application\User\Exception\UserNotFoundApplicationException;
use App\Application\Service\PasswordHasherInterface;
use App\Domain\User\Repository\UserRepositoryInterface;

final class UpdateUserUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
        private readonly PasswordHasherInterface $hasher,
    ) {}

    public function handle(UpdateUserInput $input): UserOutput
    {
        $entity = $this->repository->findById($input->id);

        if ($entity === null) {
            throw new UserNotFoundApplicationException();
        }

        if ($this->repository->emailExists($input->email, excludeId: $input->id)) {
            throw new DuplicateEmailApplicationException();
        }

        $updated = $entity->withUpdatedFields(
            name: $input->name,
            email: $input->email,
            role: $input->role,
        );

        if ($input->password !== null) {
            $updated = $updated->withPassword($this->hasher->hash($input->password));
        }

        $saved = $this->repository->update($updated);

        return UserOutput::fromEntity($saved);
    }
}
