<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

// Rutas para la gestión de cursos
Route::get('/cursos/mostrar', [CursoController::class, 'mostrar'])->middleware('auth')->name('cursos.mostrar');
Route::get('/cursos/crear', [CursoController::class, 'crear']);
Route::post('/cursos/guardar', [CursoController::class, 'guardar'])->name('cursos.guardar');
Route::get('/cursos/{id}/eliminar', [CursoController::class, 'eliminar'])->name('cursos.eliminar');;
Route::get('/cursos/modificar/{id}', [CursoController::class, 'modificar']);
Route::post('/cursos/actualizar', [CursoController::class, 'actualizar']);
Route::get('/cursos/registrar', [CursoController::class, 'registrar'])->name('cursos.registrar');
Route::get('/cursos/ver', [CursoController::class, 'ver'])->name('cursos.ver');
Route::post('/cursos/comprar', [CursoController::class, 'comprar'])->name('cursos.comprar');
Route::get('/curso/{id}/capitulos', [CursoController::class, 'capitulos'])->name('curso.capitulos');
Route::get('/capitulo/nuevo/{idCurso}', [CursoController::class, 'nuevo'])->name('capitulo.nuevo');
Route::post('/capitulo/guardar', [CursoController::class, 'guardarCapitulo'])->name('capitulo.guardar');







// Rutas de autenticación
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Otras rutas
Route::get('/', function () {
    return redirect()->route('login');
});

// Ejemplo de ruta básica
Route::get('/ruta', function() {
    return "GET";
});

Route::post('/ruta', function() {
    return "POST";
});

// Ejemplo de ruta con parámetros y vista
Route::get('/suma/{nro1}/{nro2}', function(int $nro1, int $nro2) {
    return "SUMA: " . ($nro1 + $nro2);
});

Route::get('/suma2/{nro1}/{nro2}', function(int $nro1, int $nro2) {
    return view('operaciones', [
        'nro1' => $nro1,
        'nro2' => $nro2,
        'operacion' => 'suma'
    ]);
});

// Ejemplo de ruta con vista de formulario
Route::view('/registro', 'registro');

// Ejemplo de ruta POST con vista de resultado
Route::post('/mostrar', function(Request $request) {
    return view('mostrar')
        ->with('usuario', $request->input('usuario'))
        ->with('contraseña', $request->input('contraseña'))
        ->with('contraseña2', $request->input('contraseña2'));
});

// Ejemplo de ruta para mostrar un token MD5
Route::get('/md5', function(Request $request) {
    $token = trim($request->input('token'));
    return "token=" . $token . "<br>" . md5($token);
});
