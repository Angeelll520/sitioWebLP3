@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::check() && Auth::user()->tipo == 'estudiante')
            <h2>Carrito de Compras</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
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
                        @foreach ($carrito as $curso_id => $curso)
                            <tr>
                                <td>{{ $curso['nombre'] }}</td>
                                <td>${{ $curso['precio'] }}</td>
                                <td>
                                    <form action="{{ route('carrito.eliminar', ['curso_id' => $curso_id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right">
                    <a href="{{ route('pagar') }}" class="btn btn-primary">Proceder al Pago</a>
                </div>
            @endif
        @else
            <p>No tienes permiso para ver esta página.</p>
        @endif
    </div>
@endsection
