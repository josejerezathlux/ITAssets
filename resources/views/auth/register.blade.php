@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-md-5">
        <h1 class="text-center mb-4" style="color: var(--corp-primary); font-weight: 700;"><i class="bi bi-box-seam me-2"></i>{{ config('app.name') }}</h1>
        <div class="corp-card">
            <div class="corp-card-header"><i class="bi bi-person-plus me-2"></i>Create account</div>
            <div class="corp-card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i>Create account</button>
                    <a href="{{ route('login') }}" class="btn btn-link ms-2">Already have an account?</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
