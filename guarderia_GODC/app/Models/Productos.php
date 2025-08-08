<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Productos extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = true;


        protected $fillable = [
            'nombre',
            'descripcion',
            'stock_actual',
            'precio_unitario',
            'tipo_producto'
    ];
    //relacion con uso productos
    public function usoProductos()
    {
        return $this->hasMany(Uso_productos::class, 'id_producto');
    }
}
