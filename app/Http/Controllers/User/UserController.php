<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Application\User\Exception\UserApplicationException;
use App\Application\User\UseCase\CreateUserUseCase;
use App\Application\User\UseCase\DeleteUserUseCase;
use App\Application\User\UseCase\ListUsersUseCase;
use App\Application\User\UseCase\ShowUserUseCase;
use App\Application\User\UseCase\UpdateUserUseCase;
use App\Http\Controllers\Controller;
use App\Http\Presenters\User\UserFormPresenter;
use App\Http\Presenters\User\UserIndexPresenter;
use App\Http\Presenters\User\UserShowPresenter;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class UserController extends Controller
{
    public function __construct(
        private readonly ListUsersUseCase $listUsers,
        private readonly ShowUserUseCase $showUser,
        private readonly CreateUserUseCase $createUser,
        private readonly UpdateUserUseCase $updateUser,
        private readonly DeleteUserUseCase $deleteUser,
        private readonly UserIndexPresenter $indexPresenter,
        private readonly UserFormPresenter $formPresenter,
        private readonly UserShowPresenter $showPresenter,
    ) {
    }

    public function index(): View
    {
        $outputs = $this->listUsers->handle();

        $viewModel = $this->indexPresenter->present(
            outputs: $outputs,
            success_message: session('success'),
            error_message: session('error'),
        );

        return view('users.index', compact('viewModel'));
    }

    public function create(): View
    {
        $viewModel = $this->formPresenter->presentCreate();

        return view('users.create', compact('viewModel'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $this->createUser->handle($request->toInput());
        } catch (UserApplicationException $e) {
            return redirect()->route('users.create')
                ->withInput()
                ->with('error', $e->getPublicMessage());
        }

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(int $id): View|RedirectResponse
    {
        try {
            $output = $this->showUser->handle($id);
        } catch (UserApplicationException $e) {
            return redirect()->route('users.index')
                ->with('error', $e->getPublicMessage());
        }

        $viewModel = $this->showPresenter->present($output);

        return view('users.show', compact('viewModel'));
    }

    public function edit(int $id): View|RedirectResponse
    {
        try {
            $output = $this->showUser->handle($id);
        } catch (UserApplicationException $e) {
            return redirect()->route('users.index')
                ->with('error', $e->getPublicMessage());
        }

        $viewModel = $this->formPresenter->presentEdit($output);

        return view('users.edit', compact('viewModel'));
    }

    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        try {
            $this->updateUser->handle($request->toInput($id));
        } catch (UserApplicationException $e) {
            return redirect()->route('users.edit', $id)
                ->withInput()
                ->with('error', $e->getPublicMessage());
        }

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->deleteUser->handle($id);
        } catch (UserApplicationException $e) {
            return redirect()->route('users.index')
                ->with('error', $e->getPublicMessage());
        }

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
