@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-primary">Cursos Disponibles</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Nombre del Curso</th>
            <th>Precio</th>
            <th>Instructor</th>
            <th>Duración</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productos as $producto) 
        <tr>
            <td>{{ $curso->nombre }}</td>
            <td>{{ $curso->precio }}</td>
            <td>{{ $curso->instructor }}</td>
            <td>{{ $curso->duracion }}</td>
            <td>
                <a class="btn btn-small btn-primary" href="/cursos/detalles/{{ $curso->id }}">Ver Detalles</a>
                <a class="btn btn-small btn-success" href="/cursos/comprar/{{ $curso->id }}">Comprar</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
