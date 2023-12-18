@extends('base')

@section('content')
<div class="container p-5">
    <div class="card shadow login-card">
        <div class="card-header login-header bg-dark text-white">
            <h1 class="text-center"><i class="fas fa-glass-whiskey"></i> Welcome to Milktea Registration!</h1>
        </div>
        <div class="card-body login-body">
            <form action="{{ '/register' }}" method="POST">
                {{ csrf_field() }}
                <div class="mb-3">
                    <label for="name" class="form-label milktea-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control milktea-input" placeholder="Your Full Name">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label milktea-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control milktea-input" placeholder="Your Email">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label milktea-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control milktea-input" placeholder="Your Password">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label milktea-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control milktea-input" placeholder="Your Password">
                    @error('password_confirmation')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="d-flex mt-4">
                    <div class="flex-grow-1">
                        <a href="{{ '/' }}" class="text-decoration-none milktea-link">Already sipped the milktea? Login here</a>
                    </div>
                    <button class="btn btn-primary milktea-button">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
