<?php

declare(strict_types=1);

namespace App\Application\Service;

interface PasswordHasherInterface
{
    public function hash(string $plaintext): string;
}
