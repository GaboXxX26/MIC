<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terapeutas extends Model
{
    use HasFactory;
    protected $table = 'terapeutas';
    protected $primaryKey = 'id_terapeuta';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido',
        'especialidad',
        'telefono',
        'correo',
    ];

    //relacion con sesiones
    public function sesiones()
    {
        return $this->hasMany(Sesiones::class, 'id_terapeuta');
    }

}
