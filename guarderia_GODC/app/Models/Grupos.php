<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    use HasFactory;
    protected $table = 'grupos';
    protected $primaryKey = 'ID_GRUPO';
    public $timestamps = false;

    protected $fillable = [
        'ID_EDUCADORA',
        'ID_ACTIVIDAD',
        'NOMBRE',
        'UBICACION'
    ];

    public function ninos()
    {
        return $this->belongsToMany(
            Ninos::class,
            'pertenece',
            'ID_GRUPO',
            'ID_NINO'
        );
    }
    public function actividad()
    {
        return $this->belongsTo(
            Actividad::class,
            'ID_ACTIVIDAD',
            'ID_ACTIVIDAD'
        );
    }
    public function educador()
    {
        return $this->belongsTo(
            Educador::class,
            'ID_EDUCADORA',
            'ID_EDUCADORA'
        );
    }
}
