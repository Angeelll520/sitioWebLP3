@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Proceso de Pago</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pagar.procesar') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="monto" class="form-label">Monto a Pagar</label>
                <input type="number" class="form-control" id="monto" name="monto" required>
            </div>
            <div class="mb-3">
                <label for="metodo_pago" class="form-label">Método de Pago</label>
                <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                    <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                    <option value="paypal">PayPal</option>
                    <option value="transferencia">Transferencia Bancaria</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Pagar</button>
        </form>
    </div>
@endsection
