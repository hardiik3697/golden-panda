@extends('auth.layout.app')

@section('meta')
@endsection

@section('title')
Login
@endsection

@section('styles')
<!-- Page CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
@endsection

@section('content')
<!-- Login -->
<div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-12 px-12 py-6">
    <div class="w-px-400 mx-auto pt-5 pt-lg-0">
        <h4 class="mb-3">Welcome to {{ env('APP_NAME') }}</h4>

        <form id="loginForm" class="mb-5" action="{{ route('signIn') }}" method="POST">
            @csrf
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                <label for="email">Email</label>
            </div>
            <div class="mb-5">
                <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <label for="password">Password</label>
                        </div>
                        <span class="input-group-text cursor-pointer">
                            <i class="ri-eye-off-line"></i>
                        </span>
                    </div>
                </div>
            </div>
            <button id="submit" type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
        </form>
    </div>
</div>
<!-- /Login -->
@endsection

@php
$pageJs = ['resources/js/project/auth/login.js'];
@endphp