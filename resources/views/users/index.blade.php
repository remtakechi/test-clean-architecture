@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="page-actions">
        <h1>Users</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ New User</a>
    </div>

    @if ($viewModel->success_message)
        <div class="alert alert-success">{{ $viewModel->success_message }}</div>
    @endif

    @if ($viewModel->error_message)
        <div class="alert alert-error">{{ $viewModel->error_message }}</div>
    @endif

    @if ($viewModel->hasUsers())
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewModel->users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->is_admin ? 'badge-admin' : 'badge-member' }}">
                                {{ $user->role_label }}
                            </span>
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary btn-sm">View</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color:#888; font-size:14px;">No users found. <a href="{{ route('users.create') }}">Create one</a>.</p>
    @endif
@endsection
