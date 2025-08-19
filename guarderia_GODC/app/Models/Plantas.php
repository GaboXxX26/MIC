<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantas extends Model
{
    use HasFactory;
    protected $table = 'plantas';
    protected $primaryKey = 'ID_PLANTA';
    public $timestamps = false;

    protected $fillable = [
        'ID_PROVEEDOR',
        'NOMBRE',
        'ESPECIE',
        'TIPO',
        'PRECIO',
        'STOCK',
    ];

    // //relacion con sesiones
    public function proveedores()
    {
        return $this->hasMany(Proveedores::class, 'id_proveedor');
    }

}
