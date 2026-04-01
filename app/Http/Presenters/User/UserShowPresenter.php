<?php

declare(strict_types=1);

namespace App\Http\Presenters\User;

use App\Application\User\DTO\UserOutput;
use App\Http\Presenters\User\ViewModel\UserShowViewModel;

final class UserShowPresenter
{
    public function present(UserOutput $output): UserShowViewModel
    {
        return new UserShowViewModel(
            id: $output->id,
            name: $output->name,
            email: $output->email,
            role_label: $output->role_label,
            is_admin: $output->role->value === 'admin',
            created_at: $output->created_at?->format('Y-m-d H:i') ?? '-',
            updated_at: $output->updated_at?->format('Y-m-d H:i') ?? '-',
        );
    }
}
