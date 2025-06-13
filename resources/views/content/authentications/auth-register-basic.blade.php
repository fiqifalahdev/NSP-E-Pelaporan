@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection


@section('content')
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6 mx-4">

                <!-- Register Card -->
                <div class="card p-7">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="{{ url('/') }}" class="app-brand-link gap-3">
                            <span class="app-brand-logo demo">@include('_partials.macros', ['height' => 20])</span>
                            <span
                                class="app-brand-text demo text-heading fw-semibold">{{ config('variables.templateName') }}</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <div class="card-body mt-1">
                        <h4 class="mb-1">Register Akun</h4>

                        <form id="formAuthentication" class="mb-5" action="/register" method="post">
                            @csrf
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name" autofocus>
                                <label for="name">Username</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-5">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email">
                                <label for="email">Email</label>
                            </div>
                            <div class="mb-5 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <label for="password">Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="ri-eye-off-line ri-20px"></i></span>
                                </div>
                            </div>
                            <div class="mb-5 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password_confirmation" class="form-control"
                                            name="password_confirmation" placeholder="Confirm Password" />
                                        <label for="password_confirmation">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating form-floating-outline mb-5">
                                <select class="form-select" id="role" name="role">
                                    <option value="" disabled selected>Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <!-- Tambahkan opsi lain jika perlu -->
                                </select>
                                <label for="role">Role</label>
                            </div>

                            <button class="btn btn-primary d-grid w-100 mb-5">
                                Daftar
                            </button>
                        </form>

                        <p class="text-center mb-5">
                            <span>Already have an account?</span>
                            <a href="{{ url('auth/login') }}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
                <img src="{{ asset('assets/img/illustrations/tree-3.png') }}" alt="auth-tree"
                    class="authentication-image-object-left d-none d-lg-block">
                <img src="{{ asset('assets/img/illustrations/auth-basic-mask-light.png') }}"
                    class="authentication-image d-none d-lg-block" height="172" alt="triangle-bg">
                <img src="{{ asset('assets/img/illustrations/tree.png') }}" alt="auth-tree"
                    class="authentication-image-object-right d-none d-lg-block">
            </div>
        </div>
    </div>
@endsection
