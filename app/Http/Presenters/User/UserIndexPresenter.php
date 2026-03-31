<?php

declare(strict_types=1);

namespace App\Http\Presenters\User;

use App\Application\User\DTO\UserOutput;
use App\Http\Presenters\User\ViewModel\UserIndexViewModel;
use App\Http\Presenters\User\ViewModel\UserListItemViewModel;

final class UserIndexPresenter
{
    /**
     * @param UserOutput[] $outputs
     */
    public function present(
        array $outputs,
        ?string $success_message = null,
        ?string $error_message = null,
    ): UserIndexViewModel {
        $items = array_map(fn (UserOutput $o) => new UserListItemViewModel(
            id: $o->id,
            name: $o->name,
            email: $o->email,
            role_label: $o->role_label,
            is_admin: $o->role->value === 'admin',
            created_at: $o->created_at?->format('Y-m-d H:i') ?? '-',
        ), $outputs);

        return new UserIndexViewModel(
            users: $items,
            success_message: $success_message,
            error_message: $error_message,
        );
    }
}
