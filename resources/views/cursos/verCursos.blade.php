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
            <img src="{{asset('storage').'/'.$curso->imagen }}" class="card-img-top" alt="{{ $curso->nombre }}">

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
                                    <button class="btn btn-primary comprar-curso" data-curso="{{ $curso->id }}">Comprar</button>
                                @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Script para mostrar mensaje de confirmación -->
<script>
    // Espera a que el documento esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los botones con clase 'comprar-curso'
        const botonesComprar = document.querySelectorAll('.comprar-curso');

        // Itera sobre cada botón y agrega un listener de clic
        botonesComprar.forEach(boton => {
            boton.addEventListener('click', function(e) {
                e.preventDefault(); // Previene el envío del formulario por defecto
                const cursoId = this.getAttribute('data-curso'); // Obtiene el ID del curso

                // Muestra un mensaje de confirmación
                if (confirm(`¿Estás seguro de comprar este curso?`)) {
                    // Si el usuario confirma, envía el formulario
                    const formulario = document.createElement('form');
                    formulario.method = 'POST';
                    formulario.action = '{{ route('cursos.comprar') }}';
                    formulario.style.display = 'none'; // Oculta el formulario
                    const csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    const cursoIdField = document.createElement('input');
                    cursoIdField.type = 'hidden';
                    cursoIdField.name = 'curso_id';
                    cursoIdField.value = cursoId;
                    formulario.appendChild(csrfField);
                    formulario.appendChild(cursoIdField);
                    document.body.appendChild(formulario);
                    formulario.submit(); // Envía el formulario
                } else {
                    // Si el usuario cancela, no hace nada
                    return false;
                }
            });
        });
    });
</script>
@endsection
