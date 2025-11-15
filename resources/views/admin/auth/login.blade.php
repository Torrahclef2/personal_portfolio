<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title> {{ $pagetitle }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fb;
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .card {
            border: 0;
            border-radius: .75rem;
            box-shadow: 0 6px 18px rgba(22,27,52,.08);
        }
        .form-control {
            border-color: #dbdbd7 !important;
        }
        .form-check-input:checked + .form-check-label::before {
            background-color: #0a0a0a !important;
        }
        .form-check-label::before {
            border-color: #dbdbd7 !important;
        }
        .form-check-input:focus + .form-check-label::before {
            border-color: #0a0a0a !important;
            box-shadow: 0 0 0 3px #0a0a0a !important;
        }
        .btn-primary {
            background-color: #0a0a0a !important;
            border-color: #0a0a0a !important;
        }
        .btn-primary:hover {
            background-color: #0b0b0b !important;
            border-color: #0b0b0b !important;
        }
    </style>
</head>
<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="w-100" style="max-width:420px;">
            <div class="text-center mb-4">
                <h3 class="mb-1">Admin Panel</h3>
                <small class="text-muted">Sign in to continue</small>
            </div>

            <div class="card p-4">
                @if(session('status'))
                    <div class="alert alert-info mb-3">{{ session('status') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger mb-3">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label small">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                     class="form-control @error('email') is-invalid @enderror" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label small">Password</label>
                        <input id="password" type="password" name="password" required
                                     class="form-control @error('password') is-invalid @enderror" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                        <div>
                            <a href="#" class="small">Forgot password?</a>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
            </div>

            <p class="text-center text-muted small mt-3">  {{ date('Y') }} Your Company</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
