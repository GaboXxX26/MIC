<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    protected $table = 'actividad';
    protected $primaryKey = 'ID_ACTIVIDAD';
    public $timestamps = false;
    
    protected $fillable = [
        'NOMBRE',
        'DESCRIPCION',
        'DURACION',
    ];


    public function horario()
    {
        return $this->belongsToMany(
            Horario::class,
            'programa',
            'ID_ACTIVIDAD',
            'ID_HORARIO'
        );
    }
    public function grupo()
    {
        return $this->hasMany(
            Grupos::class,
            'ID_ACTIVIDAD'
        );
    }
}
