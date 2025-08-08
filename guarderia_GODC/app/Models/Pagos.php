<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';
    public $timestamps = true;

    protected $fillable = [
        'fecha_pago',
        'monto',
        'metodo_pago',
        'estado'
    ];

    //relacion con sesiones
    public function sesiones()
    {
        return $this->hasMany(Sesiones::class, 'id_pago');
    }

}
