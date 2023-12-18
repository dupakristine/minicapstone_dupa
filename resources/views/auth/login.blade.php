@extends('base')

@section('content')
<div class="container p-5">
    <div class="card shadow login-card">
        <div class="card-header login-header bg-dark text-white">
            <h1 class="text-center"><i class="fas fa-glass-whiskey"></i> Welcome to Milktea Shop!</h1>
            @if (session('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="card-body login-body">
            <form action="{{ route('dashboard') }}" method="POST">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="d-flex mt-4">
                    <div class="flex-grow-1">
                        <a href="{{ route('registerForm') }}" class="text-decoration-none">Don't have an account? Sign up here</a>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
