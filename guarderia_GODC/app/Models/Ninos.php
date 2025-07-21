<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ninos extends Model
{
    use HasFactory;
    protected $table = 'ninos';
    protected $primaryKey = 'ID_NINO';
    public $timestamps = false;

    public function representantes()
    {
        return $this->belongsToMany(
            Representante::class,
            'representa',
            'ID_NINO',
            'ID_REPRESENTANTE'
        );
    }
    public function grupo()
    {
        return $this->belongsToMany(
            Grupos::class,
            'pertenece',
            'ID_GRUPO',
            'ID_NINO'
        );
    }
    public function asistencia()
    {
        return $this->hasMany(
            Asistencia::class,
            'ID_NINO'
        );
    }
    public function evaluaciones()
    {
        return $this->hasMany(
            Evaluaciones::class,
            'ID_NINO'
        );
    }
    
}
