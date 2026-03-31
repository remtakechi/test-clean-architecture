<?php

declare(strict_types=1);

namespace App\Domain\User\Exception;

final class DuplicateEmailException extends DomainException
{
    public function __construct(string $email)
    {
        parent::__construct("The email address is already in use.", ['email' => $email]);
    }
}
