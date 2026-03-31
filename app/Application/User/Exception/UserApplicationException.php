<?php

declare(strict_types=1);

namespace App\Application\User\Exception;

use RuntimeException;

class UserApplicationException extends RuntimeException
{
    public function getPublicMessage(): string
    {
        return $this->getMessage();
    }
}
