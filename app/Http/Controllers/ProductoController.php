<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class ProductoController
{
    public function mostrar(){
        //$resultado = DB::select("SELECT * FROM productos");
        //dd($resultado);

        //$resultado = DB::table("productos")->get();
        $producto = new Producto();
        $productos = $producto->get();
        return view("producto.mostrar")->with("productos",$productos);
    }

    public function crear(){
        return view("producto.registro");
    }

    public function guardar(Request $request){
        $request->validate([
            "nombre" => "required|unique:productos,nombre",
            "precio" => "required|numeric",
            "stock" => "required"
        ]);

        $nombre = $request->input("nombre");
        $precio = $request->input("precio");
        $stock = $request->input("stock");
        //DB::insert("INSERT INTO productos(nombre, precio, stock) VALUES(?,?,?)", [$nombre, $precio, $stock]);
        
        /*
        DB::table("productos")->insert([
            "nombre"=>$nombre,
            "precio"=>$precio,
            "stock"=>$stock
        ]);   */
        
        $producto = new Producto();
        $producto->nombre = $nombre;
        $producto->precio = $precio;
        $producto->stock = $stock;
        $producto->save();    

        return redirect("/productos/mostrar");
    }

    public function guardar2(Request $request){
        $nombre = $request->input("nombre");
        $precio = $request->input("precio");
        $stock = $request->input("stock");
               
        $producto = new Producto();
        $producto->nombre = $nombre;
        $producto->precio = $precio;
        $producto->stock = $stock;
        $producto->save();    
        return json_encode(["status"=>"success"]);
    }

    public function modificar(int $id){
        $producto = Producto::find($id);                
        return view("producto.actualizar")->with("producto", $producto);
    }

    public function actualizar(Request $request){
        $producto = Producto::find($request->input("id"));
        $producto->nombre = $request->input("nombre");
        $producto->precio = $request->input("precio");
        $producto->stock = $request->input("stock");
        $producto->save();                    
        return redirect("/productos/mostrar");
    }

    public function eliminar(int $id){
        //DB::delete("DELETE FROM productos WHERE id=?", [$id]);
        //DB::table("productos")->where("id",$id)->delete();
        $producto = Producto::find($id);
        $producto->delete();
        return "producto eliminado";
    } 
    
    public function registrar(){
        if(Auth::user()->tipo == "profesor"){
            return view("registrarCursos");
        }else{
            return redirect("/home");
        }
    }

    public function ver(){
        if(Auth::user()->tipo == "estudiante"){

            $cursos = producto::all();
            return view("verCursos",compact('cursos'));
        }else{    
            return redirect("/home");
        }    
    }


}
