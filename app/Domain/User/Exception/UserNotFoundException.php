<?php

declare(strict_types=1);

namespace App\Domain\User\Exception;

final class UserNotFoundException extends DomainException
{
    public function __construct(int $id)
    {
        parent::__construct("User not found.", ['id' => $id]);
    }
}
