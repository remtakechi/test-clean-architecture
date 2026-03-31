<?php

declare(strict_types=1);

namespace App\Http\Presenters\User;

use App\Application\User\DTO\UserOutput;
use App\Domain\User\ValueObject\UserRole;
use App\Http\Presenters\User\ViewModel\UserFormViewModel;

final class UserFormPresenter
{
    public function presentCreate(): UserFormViewModel
    {
        return new UserFormViewModel(
            id: null,
            name: '',
            email: '',
            role: UserRole::Member->value,
            role_options: $this->roleOptions(),
            is_edit: false,
        );
    }

    public function presentEdit(UserOutput $output): UserFormViewModel
    {
        return new UserFormViewModel(
            id: $output->id,
            name: $output->name,
            email: $output->email,
            role: $output->role->value,
            role_options: $this->roleOptions(),
            is_edit: true,
        );
    }

    /** @return array<string, string> */
    private function roleOptions(): array
    {
        $options = [];
        foreach (UserRole::cases() as $case) {
            $options[$case->value] = $case->label();
        }
        return $options;
    }
}
