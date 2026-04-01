<?php

declare(strict_types=1);

namespace App\Providers;

use App\Application\Service\PasswordHasherInterface;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Persistence\User\EloquentUserRepository;
use App\Infrastructure\Service\BcryptPasswordHasher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(PasswordHasherInterface::class, BcryptPasswordHasher::class);
    }

    public function boot(): void
    {
        //
    }
}
