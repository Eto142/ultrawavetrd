<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login — Chase Dever</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="w-100" style="max-width: 420px;">
        <div class="text-center mb-4">
            <img src="{{ asset('logo.png') }}" alt="Chase Dever" style="height:36px;">
        </div>

        <div class="card p-4">
            <h1 class="h4 text-light mb-1">Admin Sign In</h1>
            <p class="text-body-secondary small mb-4">Chase Dever administration panel</p>

            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-light">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Password</label>
                    <input type="password" name="password" required class="form-control">
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label text-body-secondary">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>
