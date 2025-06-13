@extends('layouts/contentNavbarLayout')

@section('title', 'Edit User')

@section('content')
    <div class="row">
        <div class="col-xl">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="ri-check-line me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('new_password'))
                <div class="alert alert-warning">
                    <strong>Password Baru :</strong> {{ session('new_password') }}
                    <small>(silahkan simpan password berikut, dan jangan berikan ke siapapun)</small>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit User</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Nama Lengkap" value="{{ old('name') ?? $user->name }}">
                            <label for="name">Nama Lengkap</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="email" id="email" class="form-control" name="email" placeholder="Email"
                                value="{{ old('email') ?? $user->email }}">
                            <label for="email">Email</label>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Role</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="role_admin" value="admin"
                                    {{ (old('role') ?? $user->role) == 'admin' ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_admin">Admin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="role_spv"
                                    value="supervisor" {{ (old('role') ?? $user->role) == 'supervisor' ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_spv">Supervisor</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="role_manager"
                                    value="manager" {{ (old('role') ?? $user->role) == 'manager' ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_manager">Manager</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="role_user" value="user"
                                    {{ (old('role') ?? $user->role) == 'user' ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_user">User</label>
                            </div>
                        </div>

                        {{-- Checkbox Reset Password --}}
                        <div class="mb-4">
                            <input type="checkbox" id="reset_password" class="form-check-input" name="reset_password"
                                {{ old('reset_password') ? 'checked' : '' }}>
                            <label for="reset_password" class="form-label d-inline">Reset Password</label>
                        </div>

                        {{-- <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="generated_password" class="form-control" name="generated_password"
                                placeholder="Password" value="{{ old('generated_password', $generatedPassword ?? '') }}"
                                readonly>
                            <label for="generated_password">Password (Otomatis)</label>
                        </div> --}}

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
