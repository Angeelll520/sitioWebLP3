@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cursos Disponibles</h2>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        @foreach($cursos as $curso)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage').'/'.$curso->imagen }}" class="card-img-top" alt="{{ $curso->nombre }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $curso->nombre }}</h5>
                    <p class="card-text">{{ $curso->descripcion }}</p>
                    <p><strong>Precio: </strong>s/{{ $curso->precio }}</p>
                    <p><strong>Duración: </strong>{{ $curso->duracion }} horas</p>
                    @if (Auth::check() && Auth::user()->tipo == 'profesor')
                        <a href="{{ route('cursos.eliminar', ['id' => $curso->id]) }}" class="btn btn-danger">Eliminar Curso</a>
                    @endif
                    @if (Auth::check() && Auth::user()->tipo == 'profesor')
                        <a href="{{ route('curso.capitulos', ['id' => $curso->id]) }}" class="btn btn-primary">Entrar al Curso</a>
                    @endif
                    @if (Auth::user()->tipo == 'estudiante')
                        <form action="{{ route('carrito.agregar', ['curso_id' => $curso->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Agregar al Carrito</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4 text-center">
        <a href="{{ route('ver.carrito') }}" class="btn btn-primary">Ver Carrito</a>
    </div>
</div>

@endsection
