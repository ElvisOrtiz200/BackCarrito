<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        $ListaCategoria=Categoria::where('estado','=','1')->get();
        return response()->json($ListaCategoria);
    }

    public function store(Request $request){
        try{
            $categoria=new Categoria();
            $categoria->descripcion=$request->descripcion;
           
            $categoria->estado=1;
            $categoria->save();
            $result=[
            'descripcion'=>$categoria->descripcion,
            'created' => true];
            return $result;
        }
            catch(Exception $e){
            return "Error fatal - ".$e->getMessage();
        }
    }

    public function show($id){
        return Categoria::find($id);
    }

    public function update(Request $request, $id){
        $producto=Categoria::findOrFail($id);
        $producto->update($request->all());
        return $producto;
    }

    public function eliminar($id) {
        $producto = Categoria::findOrFail($id);
        $producto->estado = 0; // Cambia el estado a 0
        $producto->save();
        return response()->json(['message' => 'Producto eliminado correctamente.']);
    }


}
