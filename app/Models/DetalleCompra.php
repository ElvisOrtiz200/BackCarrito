<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    protected $table = 'detalleCompra';
    protected $primaryKey = 'iddetalleCompra';
    public $timestamps = false;

    protected $fillable = [
        'idcompra',
        'idcliente',
        'idproducto',
        'cantidad',
        'precio',
        'fecha',
    ];

    // Relación con la tabla CompraCliente
    public function compraCliente()
    {
        return $this->belongsTo(CompraCliente::class, 'idcompra');
    }

    // Relación con la tabla Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idproducto');
    }

    // Relación con la tabla Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idcliente');
    }
}
