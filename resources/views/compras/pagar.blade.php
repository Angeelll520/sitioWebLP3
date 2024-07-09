@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Paso 3: Confirmar Compra</div>
        </div>

        <h2 class="mb-4">Confirmar Compra</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (empty($carrito))
            <div class="alert alert-warning">
                <p>No hay cursos en el carrito.</p>
            </div>
        @else
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Resumen de Carrito</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
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

                    <div class="text-right mt-4">
                        @php
                            $total = 0;
                            foreach ($carrito as $curso) {
                                $total += $curso['precio'];
                            }
                        @endphp
                        <h4>Total: ${{ $total }}</h4>
                        <form action="{{ route('procesar.pago') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg mt-3">Realizar Pago</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
