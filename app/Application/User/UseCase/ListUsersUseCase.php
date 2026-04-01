<?php

declare(strict_types=1);

namespace App\Application\User\UseCase;

use App\Application\User\DTO\UserOutput;
use App\Domain\User\Repository\UserRepositoryInterface;

final class ListUsersUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    /** @return UserOutput[] */
    public function handle(): array
    {
        return array_map(
            fn ($entity) => UserOutput::fromEntity($entity),
            $this->repository->findAll()
        );
    }
}
