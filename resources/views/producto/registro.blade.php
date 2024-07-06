@extends("layout.general")

@section("titulo")
    Registro de Productos
@endsection

@section("principal")
<h1 class="text-primary">Registro de Productos</h1>
<form method="post" action="/productos/guardar">
    @csrf
    <input class="form-control" @error('nombre') style="border: 1px red solid" @enderror type="text" name="nombre" placeholder="ingrese nombre" value="{{ old('nombre') }}"/>
    @error('nombre') <div class="text-danger">{{ $message }}</div> @enderror<br>
    <input class="form-control" type="text" name="precio" placeholder="ingrese precio" value="{{ old('precio') }}"/><br>
    <input class="form-control" type="number" name="stock" placeholder="confirme stock" value="{{ old('stock') }}"/><br>
    <input class="btn btn-primary" type="submit" value="guardar"/>
</form>
<p>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection