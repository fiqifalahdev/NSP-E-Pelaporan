@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah User')

@section('content')
    <div class="row">
        <div class="col-xl">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="ri-check-line me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Tambah User</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="Nama Lengkap" value="{{ old('name') }}">
                            <label for="name">Nama Lengkap</label>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="email" id="email" class="form-control" name="email" placeholder="Email"
                                value="{{ old('email') }}">
                            <label for="email">Email</label>
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Role</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="role_admin" value="admin"
                                    {{ old('role') == 'admin' ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_admin">Admin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="role_spv"
                                    value="supervisor" {{ old('role') == 'supervisor' ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_spv">Supervisor</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="role_manager"
                                    value="manager" {{ old('role') == 'manager' ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_manager">Manager</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="role_user" value="user"
                                    {{ old('role') == 'user' ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_user">User</label>
                            </div>
                        </div>

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="generated_password" class="form-control" name="generated_password"
                                placeholder="Password" value="{{ old('generated_password', $generatedPassword ?? '') }}"
                                readonly>
                            <label for="generated_password">Password (Otomatis)</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
