<?php

declare(strict_types=1);

namespace App\Http\Presenters\User\ViewModel;

final class UserIndexViewModel
{
    /**
     * @param  UserListItemViewModel[]  $users
     */
    public function __construct(
        public readonly array $users,
        public readonly ?string $success_message,
        public readonly ?string $error_message,
    ) {
    }

    public function hasUsers(): bool
    {
        return count($this->users) > 0;
    }
}
