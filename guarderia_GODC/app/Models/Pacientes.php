<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;
    protected $table = 'pacientes';
    protected $primaryKey = 'id_paciente';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'sexo',
        'telefono',
        'correo',
        'direccion'
    ];

    //relacion con sesiones
    public function sesiones()
    {
        return $this->hasMany(Sesiones::class, 'id_paciente');
    }

}
