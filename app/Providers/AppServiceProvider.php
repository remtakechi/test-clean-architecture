<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Persistence\User\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
