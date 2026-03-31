@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="page-actions">
        <h1>Edit User</h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form action="{{ route('users.update', $viewModel->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $viewModel->name) }}">
            @error('name') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $viewModel->email) }}">
            @error('email') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role">
                @foreach ($viewModel->role_options as $value => $label)
                    <option value="{{ $value }}" @selected(old('role', $viewModel->role) === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('role') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password">New Password <span style="font-weight:normal;color:#888;">(leave blank to keep current)</span></label>
            <input type="password" id="password" name="password">
            @error('password') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('users.show', $viewModel->id) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
