<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Capitulo;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class CursoController extends Controller
{
    public function mostrar()
    {
        $cursos = Curso::all();
        $randomImage = "https://picsum.photos/200/300?random=" . rand(); 

        return view("cursos.verCursos", [
            'cursos' => $cursos,
            'randomImage' => $randomImage,
        ]);
    }
    public function index()
    {
        $cursos = Curso::all();
        return view('home', compact('cursos'));
    }
    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $cursos = Curso::where('nombre', 'LIKE', "%{$query}%")
                        ->orWhere('descripcion', 'LIKE', "%{$query}%")
                        ->get();    

        return view('cursos.resultadosBusqueda', compact('cursos', 'query'));
    }

    public function crear(){
        return view("cursos.registro");
    }

    public function guardar(Request $request)
{
    $request->validate([
        "nombre" => "required|unique:cursos,nombre",
        "precio" => "required|numeric",
        "descripcion" => "required",
        "duracion" => "required",
        "imagen" => "required|image|mimes:jpeg,png,jpg,gif|max:2048", 
    ]);

    
    $curso = new Curso();
    $curso->nombre = $request->input("nombre");
    $curso->precio = $request->input("precio");
    $curso->descripcion = $request->input("descripcion");
    $curso->duracion = $request->input("duracion");

    
    if ($request->hasFile('imagen')) {
        $curso->imagen = $request->file('imagen')->store('upload', 'public');
    }


    $curso->save();

  
    return redirect("/cursos/mostrar")->with('success', '¡Curso agregado con éxito!');
}



    public function capitulos($id)
{
    $curso = Curso::findOrFail($id);
    $capitulos = $curso->capitulos;

    return view('cursos.capitulos', compact('curso', 'capitulos'));
}

public function guardarCapitulo(Request $request)
{

    $request->validate([
        'curso_id' => 'required|exists:cursos,id',
        'titulo' => 'required',
        'descripcion' => 'nullable',
        'video_link' => 'nullable|url',
    ]);


    $capitulo = new Capitulo();
    $capitulo->curso_id = $request->curso_id;
    $capitulo->titulo = $request->titulo;
    $capitulo->descripcion = $request->descripcion;
    $capitulo->video_link = $request->video_link;


    $capitulo->save();


    $curso = Curso::findOrFail($request->curso_id);

    return redirect()->route('curso.capitulos', ['id' => $curso->id])->with('success', '¡Capítulo guardado correctamente!');
}




    public function modificar(int $id){
        $curso = Curso::find($id);
        return view("cursos.actualizar")->with("curso", $curso);
    }

    public function actualizar(Request $request){
        $curso = Curso::find($request->input("id"));
        $curso->nombre = $request->input("nombre");
        $curso->precio = $request->input("precio");
        $curso->descripcion = $request->input("descripcion");
        $curso->duracion = $request->input("duracion");
      

        $curso->save();

        return redirect("/cursos/mostrar");
    }
    public function comprar(Request $request)
    {
        $user = Auth::user();
        $curso = Curso::find($request->curso_id);

        if (!$user || !$curso) {
            return redirect()->back()->with('error', 'No se pudo realizar la compra');
        }

       
        $user->cursos()->attach($curso);

        return redirect()->back()->with('success', '¡Compra realizada con éxito!');
    }

public function nuevo($idCurso) {
    return view('cursos.nuevoCapitulo', ['idCurso' => $idCurso]);
}


public function eliminar($id)
{
    $curso = Curso::find($id);

    if (!$curso) {
        return redirect()->back()->with('error', 'El curso no existe.');
    }

    
    if ($curso->imagen) {
        Storage::disk('public')->delete($curso->imagen);
    }

    
    $curso->delete();

    return redirect()->back()->with('success', 'Curso eliminado correctamente.');
}
    

    public function registrar() {
        if(Auth::check() && Auth::user()->tipo == "profesor") {
            return view("cursos.registrarCurso");
        } else {
            return redirect("/home");
        }
    }

    

    public function ver() {
        if(Auth::check() && Auth::user()->tipo == "estudiante") {
            $estudianteId = Auth::id();
            $cursosComprados = Curso::whereHas('usuarios', function ($query) use ($estudianteId) {
                $query->where('user_id', $estudianteId);
            })->get();
    
            return view("compras.cursosComprados", compact('cursosComprados'));
        } else {
            return redirect("/home");
        }
    }

    public function agregarAlCarrito($curso_id)
{
    $curso = Curso::find($curso_id);

    if (!$curso) {
        return redirect()->back()->with('error', 'El curso no existe.');
    }

    $carrito = session()->get('carrito');

  
    if (!$carrito) {
        $carrito = [];
    }

 
    $carrito[$curso_id] = [
        'id' => $curso->id,
        'nombre' => $curso->nombre,
        'precio' => $curso->precio,
        'descripcion' => $curso->descripcion,
        
    ];

    
    session()->put('carrito', $carrito);

    return redirect()->back()->with('success', 'Curso agregado al carrito.');
}

public function verCarrito()
{
    $carrito = session()->get('carrito');

    return view('compras.ver', compact('carrito'));
}

public function eliminarDelCarrito($curso_id)
{
    $carrito = session()->get('carrito');

    if (isset($carrito[$curso_id])) {
        unset($carrito[$curso_id]);
        session()->put('carrito', $carrito);
    }

    return redirect()->back()->with('success', 'Curso eliminado del carrito.');
}

public function pagar()
    {
        $carrito = session()->get('carrito');


        return view('compras.pagar', compact('carrito'));
    }

    public function procesarPago(Request $request)
{
    $user = Auth::user();
    $carrito = session()->get('carrito');

    if (!$user || empty($carrito)) {
        return redirect()->back()->with('error', 'No se pudo realizar la compra.');
    }

    foreach ($carrito as $curso) {
        $user->cursos()->attach($curso['id']);
    }

    session()->forget('carrito');

    return redirect()->route('cursos.ver')->with('success', '¡Compra realizada con éxito!');
}


    public function realizarPago(Request $request)
{
    $user = Auth::user();
    $carrito = session()->get('carrito');

    if (!$user || empty($carrito)) {
        return redirect()->back()->with('error', 'No se pudo realizar la compra.');
    }

    foreach ($carrito as $curso) {
        $user->cursos()->attach($curso['id']);
    }

   
    session()->forget('carrito');

    return redirect()->route('cursos.ver')->with('success', '¡Compra realizada con éxito!');
}

    public function calcularTotalCarrito($carrito)
    {
    $total = 0;

    foreach ($carrito as $curso) {
        $total += $curso['precio'];
    }

    return $total;
    }

    public function devolverCursoComprado($curso_id)
{
    $user = Auth::user();
    $curso = Curso::find($curso_id);

    if (!$user || !$curso) {
        return redirect()->back()->with('error', 'No se pudo devolver el curso.');
    }

    
    $user->cursos()->detach($curso_id);

    return redirect()->route('cursos.ver')->with('success', '¡Curso devuelto con éxito!');
}

    
}
