@extends('auth.loginmaster')

@section('title', 'User Login')

@push('scripts')
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        document.addEventListener('DOMContentLoaded', function(e) {
            $("#eye").click(function() {
                $(this).toggleClass('bi-eye');
                $(this).toggleClass('bi-eye-slash');
                const isPasswordVisible = document.getElementById("password").getAttribute("type") ===
                    "text";
                if (isPasswordVisible) {
                    document.getElementById("password").setAttribute("type", "password");
                    document.getElementById("eye").style.color = '#7a797e';
                } else {
                    document.getElementById("password").setAttribute("type", "text");
                    document.getElementById("eye").style.color = '#5887ef';
                }
            });
        });
    </script>
@endpush
@section('page-content')

    <div class="login d-flex justify-content-center align-items-center">
        <div class="auth-content overflow-hidden rounded-3 shadow-sm">
            <div class="col-12">
                <form class="form-signin auth-right d-flex flex-column align-items-center justify-content-center h-100 pt-3"
                    action="{{ route('login.authenticate') }}" method="POST" autocomplete="off">
                    <div class="app-brand-logo">
                        <a href="#">
                            <img src="{{ asset('img/to-do.png') }}" class="w-100" alt="">
                        </a>
                    </div>
                    <h2 class="fs-5 text-uppercase fw-bold mt-3">sign in</h2>

                    @if (session('warning_message'))
                        <span class="badge bg-danger justify-content-start p-2 w-75 text-capitalize"><i
                                class="bi-exclamation-octagon-fill"></i> {!! session('warning_message') !!}</span>
                    @endif
                    @if (session('success_message'))
                        <span class="badge bg-success justify-content-start p-2 w-75 text-capitalize"><i
                                class="bi-exclamation-octagon-fill"></i> {!! session('success_message') !!}</span>
                    @endif

                    <div class="login-wrap p-4 w-100 d-flex flex-column gap-2">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="User ID" autofocus name="user_code"
                                value="{!! old('user_code') !!}">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password"
                                id="password">
                            <span><i class="bi-eye" id="eye"></i></span>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="rememberme" class="fw-bold"><input type="checkbox" name="remember"
                                            id="remember">
                                        Remember Me</label>
                                </div>
                                <div class="col-lg-6">
                                    <a href="#" class="float-end text-decoration-none fw-bold">Forgot
                                        password</a>
                                </div>
                            </div>
                        </div>
                        {{-- @if (request()->has('previous'))
                            <input type="hidden" name="previous" value="{{ request()->get('previous') }}">
                        @else
                            <input type="hidden" name="previous" value="{{ url()->previous() }}">
                        @endif --}}

                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <button class="btn btn-warning text-dark col-12 fw-bold mb-3" type="submit">Sign In</button>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Register</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
