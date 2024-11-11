<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table='usuarios';
    protected $primaryKey='id';
    public $timestamps=false;
    protected
    $fillable=['nombre_usuario','contra','estado','cliente_id'];
    
    public function cliente(){
        return $this->hasMany(Cliente::class,'cliente_id');
    }
}