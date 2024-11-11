<?php

namespace App\Http\Controllers;

use App\Models\CompraCliente;
use App\Models\DetalleCompra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    // Registrar una nueva compra
    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'cliente_id' => 'required|integer|exists:clientes,cliente_id',
            'productos' => 'required|array',
            'productos.*.idproducto' => 'required|integer|exists:productos,idproducto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        // Calcular el precio total
        $precioTotal = 0;
        foreach ($request->productos as $producto) {
            $precioTotal += $producto['cantidad'] * $producto['precio'];
        }

        // Crear la compra
        $compra = CompraCliente::create([
            'cliente_id' => $request->cliente_id,
            'preciototal' => $precioTotal,
            'fecha' => now(),
        ]);

        // Crear los detalles de la compra
        foreach ($request->productos as $producto) {
            DetalleCompra::create([
                'idcompra' => $compra->id_compra_cliente,
                'idcliente' => $request->cliente_id,
                'idproducto' => $producto['idproducto'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
                'fecha' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Compra realizada con éxito',
            'compra' => $compra,
            'detalles' => $compra->detallesCompra,
        ]);
    }

    // Obtener las compras de un cliente
    public function getCompras($clienteId)
    {
        $compras = CompraCliente::with('detallesCompra.producto')
            ->where('cliente_id', $clienteId)
            ->get();

        return response()->json($compras);
    }


}
