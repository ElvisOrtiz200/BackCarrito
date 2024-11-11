<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){
        $ListaCategoria=Cliente::where('estado','=','1')->get();
        return response()->json($ListaCategoria);
    }

    public function getClientes()
{
    $clientes = Cliente::select('cliente_id', 'nombres')->get();
    return response()->json($clientes);
}


    public function     store(Request $request){
        try{
            $cliente=new Cliente();
            $cliente->nombres=$request->nombres;
            $cliente->ruc_dni=$request->ruc_dni;
            $cliente->email=$request->email;
            $cliente->direccion=$request->direccion;
            $cliente->estado=1;
            $cliente->save();
            $result=[
            'nombres'=>$cliente->nombres,
            'ruc_dni'=>$cliente->ruc_dni,
            'email'=>$cliente->email,
            'direccion'=>$cliente->direccion,
            'created' => true];
            return $result;
        }
            catch(Exception $e){
            return "Error fatal - ".$e->getMessage();
        }
    }

    public function show($id){
        return Cliente::find($id);
    }

    public function update(Request $request, $id){
        $producto=Cliente::findOrFail($id);
        $producto->update($request->all());
        return $producto;
    }

    public function eliminar($id) {
        $producto = Cliente::findOrFail($id);
        $producto->estado = 0; // Cambia el estado a 0
        $producto->save();
        return response()->json(['message' => 'Producto eliminado correctamente.']);
    }


}
