<?php

declare(strict_types=1);

namespace App\Application\User\Exception;

final class DuplicateEmailApplicationException extends UserApplicationException
{
    public function __construct()
    {
        parent::__construct("This email address is already registered.");
    }
}
