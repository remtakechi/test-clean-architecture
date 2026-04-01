<?php

declare(strict_types=1);

namespace App\Application\User\UseCase;

use App\Application\User\DTO\UserOutput;
use App\Application\User\Exception\UserNotFoundApplicationException;
use App\Domain\User\Repository\UserRepositoryInterface;

final class ShowUserUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    public function handle(int $id): UserOutput
    {
        $entity = $this->repository->findById($id);

        if ($entity === null) {
            throw new UserNotFoundApplicationException();
        }

        return UserOutput::fromEntity($entity);
    }
}
