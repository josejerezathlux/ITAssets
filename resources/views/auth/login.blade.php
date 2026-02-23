<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} – Sign in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/corporate.css') }}" rel="stylesheet">
</head>
<body class="login-page">
    <div class="login-page-bg" aria-hidden="true"></div>
    <div class="login-page-content">
        <div class="login-card">
            <div class="login-card-brand">
                <span class="login-brand-icon"><i class="bi bi-box-seam"></i></span>
                <h1 class="login-brand-title">{{ config('app.name') }}</h1>
                <p class="login-brand-tagline">Sign in to manage your asset inventory</p>
            </div>
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <div class="login-field">
                    <label for="email" class="login-label">Email</label>
                    <input type="email" name="email" id="email" class="login-input @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="you@company.com" required autofocus autocomplete="email">
                    @error('email')
                        <div class="login-invalid">{{ $message }}</div>
                    @enderror
                </div>
                <div class="login-field">
                    <label for="password" class="login-label">Password</label>
                    <input type="password" name="password" id="password" class="login-input" placeholder="••••••••" required autocomplete="current-password">
                    @error('password')
                        <div class="login-invalid">{{ $message }}</div>
                    @enderror
                </div>
                <div class="login-options">
                    <label class="login-remember">
                        <input type="checkbox" name="remember" class="form-check-input">
                        <span>Remember me</span>
                    </label>
                </div>
                <button type="submit" class="login-submit">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign in
                </button>
            </form>
        </div>
        <p class="login-footer">&copy; {{ date('Y') }} {{ config('app.name') }}</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
