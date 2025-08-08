<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uso_productos extends Model
{
    use HasFactory;
    protected $table = 'uso_productos';
    protected $primaryKey = 'id_uso';
    public $timestamps = true;

    protected $fillable = [
        'id_uso',
        'id_producto',
        'id_sesion',
        'cantidad_utilizada',
        'observaciones'
    ];

    // Relacion con productos
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }

    // Relacion con sesiones
    public function sesion()
    {
        return $this->belongsTo(Sesiones::class, 'id_sesion');
    }

}
