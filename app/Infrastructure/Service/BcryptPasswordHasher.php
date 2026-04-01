<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Application\Service\PasswordHasherInterface;
use Illuminate\Support\Facades\Hash;

final class BcryptPasswordHasher implements PasswordHasherInterface
{
    public function hash(string $plaintext): string
    {
        return Hash::make($plaintext);
    }
}
