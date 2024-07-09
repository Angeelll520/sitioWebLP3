@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f7f9fa;">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">{{ __('Iniciar Sesión') }}</h3>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Recordarme') }}
                        </label>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Iniciar Sesión') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu Contraseña?') }}
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
    }

    .card {
        border-radius: 8px;
    }

    .card-body {
        padding: 2rem;
    }

    .form-control {
        border-radius: 4px;
        padding: 0.75rem;
    }

    .btn-primary {
        background-color: #a435f0;
        border-color: #a435f0;
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: bold;
    }

    .btn-link {
        color: #a435f0;
    }

    .btn-link:hover {
        color: #722ac8;
        text-decoration: underline;
    }

    .form-label {
        font-weight: bold;
    }

    .form-check-label {
        font-weight: normal;
    }
</style>
@endsection

