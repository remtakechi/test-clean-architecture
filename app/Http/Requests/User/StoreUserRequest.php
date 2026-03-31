<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Application\User\DTO\CreateUserInput;
use App\Domain\User\ValueObject\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreUserRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', Rule::in(UserRole::values())],
        ];
    }

    public function toInput(): CreateUserInput
    {
        return new CreateUserInput(
            name: $this->validated('name'),
            email: $this->validated('email'),
            password: $this->validated('password'),
            role: UserRole::from($this->validated('role')),
        );
    }
}
