<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return redirect()->route('login');
});

//
Route::get("/ruta", function(){
    return "GET";
});
Route::post("/ruta",function(){
    return "POST";
});
Route::view("/rutaPost", "formPost");

Route::get("/suma/{nro1}/{nro2}",function(int $nro1, int $nro2){
    return "SUMA: ".($nro1+$nro2);
});

Route::get("/resta/{nro1}/{nro2}",function(int $nro1, int $nro2){
    return "RESTA: ".($nro1-$nro2);
});

Route::get("/multiplicacion/{nro1}/{nro2}",function(int $nro1, int $nro2){
    return "MULTIPLICACION: ".($nro1*$nro2);
});

Route::get("/division/{nro1}/{nro2}",function(int $nro1, int $nro2){
    return "DIVISION: ".($nro1/$nro2);
});

Route::get("/suma2/{nro1}/{nro2}",function(int $nro1, int $nro2){
    return view("operaciones", [
        "nro1"=>$nro1, 
        "nro2"=>$nro2, 
        "operacion"=>"suma"
    ]);
});

Route::get("/multiplicacion2/{nro1}/{nro2}",function(int $nro1, int $nro2){
    return view("operaciones")
            ->with("nro1",$nro1)
            ->with("nro2",$nro2)
            ->with("operacion","multiplicacion");
});

Route::view("/registro", "registro");
Route::post("/mostrar",function(Request $request){
    return view("mostrar")
            ->with("usuario",$request->input("usuario"))
            ->with("contraseña",$request->input("contraseña"))
            ->with("contraseña2",$request->input("contraseña2"));
});

Route::get("/md5",function(Request $request){
    $token = trim($request->input("token"));
    return "token=".$token."<br>".md5($token);
});

Route::get("/productos/mostrar", [ProductoController::class, "mostrar"])->middleware("auth");
Route::get("/productos/guardar", [ProductoController::class, "crear"]);
Route::post("/productos/guardar", [ProductoController::class, "guardar"]);
Route::get("/productos/{id}/eliminar", [ProductoController::class, "eliminar"]);
//Route::get("/productos/{id}/{stock}/actualizar", [ProductoController::class, "actualizar"]);
Route::get("/productos/modificar/{id}", [ProductoController::class, "modificar"]);
Route::post("/productos/actualizar", [ProductoController::class, "actualizar"]);

Route::post("/productos/guardar2", [ProductoController::class, "guardar2"]);

Route::get("/notas/registrar", [ProductoController::class, "registrar"]);
Route::post('/notas/registrar', [ProductoController::class, 'guardar'])->name('notas.guardar');
Route::get("/notas/ver", [ProductoController::class, "ver"]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
