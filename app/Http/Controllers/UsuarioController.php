<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function verificarUsuario(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre_usuario' => 'required|string',
            'contra' => 'required|string'
        ]);
    
        // Buscar el usuario por su nombre y cargar la relación cliente usando join
        $usuario = Usuario::join('clientes', 'usuarios.cliente_id', '=', 'clientes.cliente_id')
                          ->where('nombre_usuario', $request->nombre_usuario)
                          ->first(['usuarios.*', 'clientes.*']); // Seleccionamos las columnas que necesitamos
    
        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && $request->contra === $usuario->contra) {
            // Retornar los datos del usuario junto con el cliente relacionado
            return response()->json([
                'message' => 'Usuario autenticado correctamente',
                'usuario' => $usuario
            ]);
        }
    
        return response()->json(['message' => 'Nombre de usuario o contraseña incorrectos'], 401);
    }
    


    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'nombre_usuario' => 'required|string|max:255|unique:usuarios',
            'contra' => 'required|string|min:6',
            'cliente_id' => 'required|exists:clientes,cliente_id', // Aseguramos que el cliente exista en la base de datos
        ]);

        // Si la validación falla, retorna errores
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // Código de error de validación
        }

        // Verificar si el cliente existe
        $cliente = Cliente::find($request->cliente_id);
        if (!$cliente) {
            return response()->json([
                'message' => 'Cliente no encontrado.'
            ], 404); // Error si el cliente no existe
        }

        // Crear un usuario nuevo
        $usuario = new Usuario();
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->contra = $request->contra; // No encriptamos la contraseña
        $usuario->estado = 1; // Estado por defecto es 1
        $usuario->cliente_id = $cliente->cliente_id; // Relacionamos el usuario con el cliente
        $usuario->save();

        // Devolver una respuesta exitosa
        return response()->json([
            'message' => 'Usuario registrado exitosamente.',
            'usuario' => $usuario,
            'cliente' => $cliente
        ], 201); // Código de éxito de creación
    }
}
