@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f7f9fa;">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">{{ __('Registrarse') }}</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name" class="form-label">{{ __('Nombre') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="form-group mb-3">
                        <label for="tipo" class="form-label">{{ __('Tipo de Usuario') }}</label>
                        <select id="tipo" name="tipo" class="form-select">
                            <option value="profesor">Profesor</option>
                            <option value="estudiante">Estudiante</option>
                        </select>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Registrarse') }}
                        </button>
                    </div>
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

    .form-select {
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
</style>
@endsection
