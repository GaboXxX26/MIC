<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horario';
    protected $primaryKey = 'ID_HORARIO';
    public $timestamps = false;

    protected $fillable = [
        'HORA_INICIO',
        'HORA_FIN',
    ];
    
    public function actividad()
    {
        return $this->belongsToMany(
            Actividad::class,
            'programa',
            'ID_ACTIVIDAD',
            'ID_HORARIO'
        );
    }

}
