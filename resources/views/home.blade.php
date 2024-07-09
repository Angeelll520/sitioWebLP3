@extends('layouts.app')

@section('content')
<div class="container">
   
    <div id="featuredCoursesCarousel" class="carousel slide mb-4" data-ride="carousel">
        <div class="carousel-inner">
        </div>
        <a class="carousel-control-prev" href="#featuredCoursesCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#featuredCoursesCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="mb-4">
        <form action="{{ route('cursos.buscar') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="query" placeholder="Buscar cursos...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        @foreach ($cursos as $curso)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $curso->imagen) }}" class="card-img-top" alt="{{ $curso->nombre }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $curso->nombre }}</h5>
                        <p class="card-text">{{ Str::limit($curso->descripcion, 100) }}</p>
                        <div class="mt-auto">
                            <p class="font-weight-bold">${{ $curso->precio }}</p>
                            <a href="{{ route('cursos.mostrar', $curso->id) }}" class="btn btn-primary">Ver curso</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
