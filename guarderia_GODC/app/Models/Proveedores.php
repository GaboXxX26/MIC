<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Proveedores extends Model
{
    use HasFactory;
    protected $table = 'proveedores';
    protected $primaryKey = 'ID_PROVEEDORES';
    public $timestamps = false;


        protected $fillable = [
            'DIRECCION',
            'CONTACTO',
            'PRODUCTOS',
    ];
    //relacion con uso productos
    public function Plantas()
    {
        return $this->hasMany(Plantas::class, 'id_proveedor');
    }
}
