@extends('layouts.app')

@section('title', $viewModel->name)

@section('content')
    <div class="page-actions">
        <h1>{{ $viewModel->name }}</h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <table class="detail-table" style="margin-bottom: 24px;">
        <tr>
            <th>ID</th>
            <td>{{ $viewModel->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $viewModel->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $viewModel->email }}</td>
        </tr>
        <tr>
            <th>Role</th>
            <td>
                <span class="badge {{ $viewModel->is_admin ? 'badge-admin' : 'badge-member' }}">
                    {{ $viewModel->role_label }}
                </span>
            </td>
        </tr>
        <tr>
            <th>Created</th>
            <td>{{ $viewModel->created_at }}</td>
        </tr>
    </table>

    <div class="actions">
        <a href="{{ route('users.edit', $viewModel->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('users.destroy', $viewModel->id) }}" method="POST"
              onsubmit="return confirm('Delete this user?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
