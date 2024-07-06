@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            Agregar Nuevo Capítulo
        </div>
        <div class="card-body">
            <form action="{{ route('capitulo.guardar') }}" method="POST">
                @csrf
                <input type="hidden" name="curso_id" value="{{ $idCurso }}">
                
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="video_link" class="form-label">Link del Video (opcional):</label>
                    <input type="text" class="form-control" id="video_link" name="video_link">
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
@endsection
