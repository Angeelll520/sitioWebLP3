@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Confirmar Compra</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (empty($carrito))
            <p>No hay cursos en el carrito.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrito as $curso)
                        <tr>
                            <td>{{ $curso['nombre'] }}</td>
                            <td>${{ $curso['precio'] }}</td>
                            <td>
                                <form action="{{ route('carrito.eliminar', ['curso_id' => $curso['id']]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right">
                @php
                    $total = 0;
                    foreach ($carrito as $curso) {
                        $total += $curso['precio'];
                    }
                @endphp
                <h4>Total: ${{ $total }}</h4>
                <form action="{{ route('realizar.pago') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Realizar Pago</button>
                </form>
            </div>
        @endif
    </div>
@endsection