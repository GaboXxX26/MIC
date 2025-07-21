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
    
    public function horario()
    {
        return $this->belongsToMany(
            Horario::class,
            'progrma',
            'ID_ACTIVIDAD',
            'ID_HORARIO'
        );
    }
    public function grupo()
    {
        return $this->belongsTo(
            Grupos::class,
            'ID_GRUPO'
        );
    }
}
