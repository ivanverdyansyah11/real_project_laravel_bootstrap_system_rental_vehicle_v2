@extends('template.main')

@section('content-auth')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="topbar-login d-flex align-items-center justify-content-start">
                <div class="container">
                    <img src="{{ asset('assets/image/brand/brand-logo.svg') }}" alt="Brand Logo" height="52">
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xxl-3 mt-5">
            <div class="container">
                <div class="card-login d-flex flex-column align-items-center">
                    @if (session()->has('success'))
                        <div class="alert alert-success w-100 mb-3" role="alert">
                            {{ session('success') }}
                        </div>
                    @elseif(session()->has('failed'))
                        <div class="alert alert-danger w-100 mb-3" role="alert">
                            {{ session('failed') }}
                        </div>
                    @endif
                    <h2 class="title w-100">Login 👋🏻</h2>
                    <p class="w-100">Log in to your account to access all our features and services.</p>
                    <form class="form d-flex flex-column gap-3 w-100" method="POST"
                        action="{{ route('login.authentication') }}">
                        @csrf
                        <div class="input-group d-flex flex-column">
                            <label for="email">Email</label>
                            <input type="email" class="input w-100" name="email" id="email"
                                placeholder="Enter your email.." autocomplete="off">
                        </div>
                        <div class="input-group d-flex flex-column">
                            <label for="password">Password</label>
                            <input type="password" class="input w-100" name="password" id="password"
                                placeholder="Enter your password.." autocomplete="off">
                        </div>
                        <button type="submit" class="button-primary">Login Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
