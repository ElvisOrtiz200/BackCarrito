<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraCliente extends Model
{
    use HasFactory;
    protected $table = 'compra_cliente';
    protected $primaryKey = 'id_compra_cliente';
    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'preciototal',
        'fecha',
    ];

       // Relación con la tabla cliente
       public function cliente()
       {
           return $this->belongsTo(Cliente::class, 'cliente_id');
       }
   
       // Relación con los detalles de compra
       public function detallesCompra()
       {
           return $this->hasMany(DetalleCompra::class, 'idcompra');
       }
}
