<?php

declare(strict_types=1);

namespace App\Application\User\UseCase;

use App\Application\User\Exception\UserNotFoundApplicationException;
use App\Domain\User\Repository\UserRepositoryInterface;

final class DeleteUserUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {}

    public function handle(int $id): void
    {
        $entity = $this->repository->findById($id);

        if ($entity === null) {
            throw new UserNotFoundApplicationException();
        }

        $this->repository->delete($id);
    }
}
