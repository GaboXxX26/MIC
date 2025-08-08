<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipos_terapias extends Model
{
    use HasFactory;
    protected $table = 'tipos_terapias';
    protected $primaryKey = 'id_terapia';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion_aproximada',
        'costo_base'
    ];

    //relacion con sesiones
    public function sesiones()
    {
        return $this->hasMany(Sesiones::class, 'id_terapia');
    }

}
