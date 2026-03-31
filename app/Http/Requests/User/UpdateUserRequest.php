<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Application\User\DTO\UpdateUserInput;
use App\Domain\User\ValueObject\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', Rule::in(UserRole::values())],
        ];
    }

    public function toInput(int $id): UpdateUserInput
    {
        return new UpdateUserInput(
            id: $id,
            name: $this->validated('name'),
            email: $this->validated('email'),
            role: UserRole::from($this->validated('role')),
            password: $this->validated('password') ?: null,
        );
    }
}
