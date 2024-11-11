<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table='clientes';
    protected $primaryKey='cliente_id';
    public $timestamps=false;
    protected
    $fillable=['ruc_dni','nombres','email','direccion','estado'];
    public function usuario(){
        return $this->belongsTo(Usuario::class,'cliente_id');
    }

    
}
