@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Resultados de la búsqueda para "{{ $query }}"</h2>
    @if ($cursos->isEmpty())
        <p>No se encontraron cursos.</p>
    @else
        <div class="row">
            @foreach ($cursos as $curso)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $curso->imagen) }}" class="card-img-top" alt="{{ $curso->nombre }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $curso->nombre }}</h5>
                            <p class="card-text">{{ $curso->descripcion }}</p>
                            <p class="font-weight-bold">${{ $curso->precio }}</p>
                            <a href="{{ route('cursos.detalle', $curso->id) }}" class="btn btn-primary mt-auto">Ver Más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
