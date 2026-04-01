<?php

declare(strict_types=1);

namespace App\Http\Presenters\User\ViewModel;

final class UserFormViewModel
{
    /**
     * @param  array<string, string>  $role_options  [value => label]
     */
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
        public readonly array $role_options,
        public readonly bool $is_edit,
    ) {
    }
}
