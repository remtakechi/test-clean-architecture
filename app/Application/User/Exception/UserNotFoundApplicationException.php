<?php

declare(strict_types=1);

namespace App\Application\User\Exception;

final class UserNotFoundApplicationException extends UserApplicationException
{
    public function __construct()
    {
        parent::__construct('The specified user could not be found.');
    }
}
