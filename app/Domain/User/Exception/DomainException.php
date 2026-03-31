<?php

declare(strict_types=1);

namespace App\Domain\User\Exception;

use RuntimeException;

class DomainException extends RuntimeException
{
    public function __construct(string $message, public readonly array $details = [])
    {
        parent::__construct($message);
    }
}
