<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\Entity\UserEntity;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\UserRole;
use App\Models\User as UserModel;

final class EloquentUserRepository implements UserRepositoryInterface
{
    public function __construct(private readonly UserModel $model)
    {
    }

    public function findById(int $id): ?UserEntity
    {
        $model = $this->model->find($id);

        return $model ? $this->toEntity($model) : null;
    }

    /** @return UserEntity[] */
    public function findAll(): array
    {
        return $this->model
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn ($m) => $this->toEntity($m))
            ->all();
    }

    public function emailExists(string $email, ?int $excludeId = null): bool
    {
        $query = $this->model->where('email', $email);

        if ($excludeId !== null) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    public function create(UserEntity $user): UserEntity
    {
        $model = $this->model->create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'role' => $user->role->value,
        ]);

        return $this->toEntity($model);
    }

    public function update(UserEntity $user): UserEntity
    {
        $model = $this->model->findOrFail($user->id);

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role->value,
        ];

        if ($user->password !== null) {
            $data['password'] = $user->password;
        }

        $model->update($data);

        return $this->toEntity($model->refresh());
    }

    public function delete(int $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    private function toEntity(UserModel $model): UserEntity
    {
        return new UserEntity(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            password: $model->password,
            role: UserRole::from($model->role),
            created_at: $model->created_at
                ? \DateTimeImmutable::createFromMutable($model->created_at->toDateTime())
                : null,
            updated_at: $model->updated_at
                ? \DateTimeImmutable::createFromMutable($model->updated_at->toDateTime())
                : null,
        );
    }
}
