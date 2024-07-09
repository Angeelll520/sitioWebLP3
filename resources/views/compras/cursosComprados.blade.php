@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cursos Comprados</div>

                <div class="card-body">
                    @if ($cursosComprados->isEmpty())
                        <p>No tienes cursos comprados.</p>
                    @else
                        <div class="list-group">
                            @foreach ($cursosComprados as $curso)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage').'/'.$curso->imagen }}" class="rounded-circle me-3" alt="{{ $curso->nombre }}" style="width: 50px; height: 50px;">
                                            <div>
                                                <h5 class="mb-1">{{ $curso->nombre }}</h5>
                                                <p class="mb-1">{{ $curso->descripcion }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="badge bg-primary rounded-pill">Precio: ${{ $curso->precio }}</span>
                                            <a href="{{ route('curso.capitulos', ['id' => $curso->id]) }}" class="btn btn-primary">Entrar al Curso</a>
                                            <form action="{{ route('cursos.devolver', ['curso_id' => $curso->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Devolver</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
