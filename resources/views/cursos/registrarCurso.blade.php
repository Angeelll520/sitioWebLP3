

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-primary">Registrar Curso</h1>
    <form action="{{ route('cursos.guardar') }}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="form-group mb-3">
            <label for="nombre">Nombre del Curso</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="precio">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" required>
        </div>

        <div class="form-group mb-3">
            <label for="instructor">Instructor</label>
            <input type="text" class="form-control" id="instructor" name="instructor" required>
        </div>

        <div class="form-group mb-3">
            <label for="duracion">Duración</label>
            <input type="text" class="form-control" id="duracion" name="duracion" required>
        </div>

        <div class="form-group mb-3">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required></textarea>
        </div>

        <div class="mb-3">
        <label for="imagen" >Imagen del curso</label>
        <input type="file" class="form-control" id="imagen" name="imagen" required>
    </div>
    
        <button type="submit" class="btn btn-primary">Registrar Curso</button>
    </form>
</div>
@endsection
