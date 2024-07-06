<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Capitulo;
use App\Models\Curso;
use App\Models\User;

class CursoController extends Controller
{
    public function mostrar(){
        $cursos = Curso::all();
        return view("cursos.verCursos", compact('cursos'));
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

    public function guardar(Request $request){
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
    
        // Procesar la imagen
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('upload','public');
            $curso->imagen = $imagenPath;
        }
    
        $curso->save();
    
        return redirect("/cursos/mostrar");
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
}
