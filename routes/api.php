<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/categorias', [CategoriaController::class, 'index']);
// Ruta para obtener todos los productos

// Ruta para crear un nuevo producto
Route::post('/categorias', [CategoriaController::class, 'store']);

// Ruta para obtener un producto específico
Route::get('/categorias/{id}', [CategoriaController::class, 'show']);

// Ruta para actualizar un producto específico
Route::put('/categorias/{id}', [CategoriaController::class, 'update']);

Route::put('/categorias/eliminar/{id}', [CategoriaController::class, 'eliminar']);



Route::get('/clientes', [ClienteController::class, 'index']);
// Ruta para obtener todos los productos

// Ruta para crear un nuevo producto
Route::post('/clientes', [ClienteController::class, 'store']);

// Ruta para obtener un producto específico
Route::get('/clientes/{id}', [ClienteController::class, 'show']);

// Ruta para actualizar un producto específico
Route::put('/clientes/{id}', [ClienteController::class, 'update']);

Route::put('/clientes/eliminar/{id}', [ClienteController::class, 'eliminar']);

Route::get('/clientesSeleccion', [ClienteController::class, 'getClientes']);





// Ruta para obtener todos los productos
Route::get('/productos', [ProductoController::class, 'index']);

// Ruta para crear un nuevo producto
Route::post('/productos', [ProductoController::class, 'store']);

// Ruta para obtener un producto específico
Route::get('/productos/{id}', [ProductoController::class, 'show']);

// Ruta para actualizar un producto específico
Route::put('/productos/{id}', [ProductoController::class, 'update']);

Route::put('/productos/eliminar/{id}', [ProductoController::class, 'eliminar']);




Route::post('/verificar-usuario', [UsuarioController::class, 'verificarUsuario']);
Route::post('register', [UsuarioController::class, 'register']);




// Ruta para registrar una nueva compra
Route::post('/compras', [CompraController::class, 'store']);

// Ruta para obtener las compras de un cliente
Route::get('/compras/{clienteId}', [CompraController::class, 'getCompras']);