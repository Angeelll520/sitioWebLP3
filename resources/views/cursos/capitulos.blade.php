@extends('layouts.app')

@section('content')
<div class="container">

    <div class="mb-3">
    @if (Auth::check() && Auth::user()->tipo == 'profesor')
        <a href="{{ route('capitulo.nuevo', ['idCurso' => $curso->id]) }}" class="btn btn-primary">Agregar Capítulo</a>
        @endif
    </div>
    
                    

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Video</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($capitulos as $capitulo)
                <tr>
                    <td>{{ $capitulo->titulo }}</td>
                    <td>{{ $capitulo->descripcion }}</td>
                    <td>
                    @if ($capitulo->video_link)
                            <a href="{{ $capitulo->video_link }}" target="_blank" class="btn btn-sm btn-success">Ver video</a>
                        @else
                            Sin video
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
