<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $table = 'asistencia';
    protected $primaryKey = 'ID_ASISTENCIA';
    public $timestamps = false;

    protected $fillable = [
        'ID_NINO',
        'FECHA',
        'HORA_ENTRADA',
        'HORA_SALIDA',
        'OBSERVACIONES',
    ];

    public function nino()
    {
        return $this->belongsTo(Ninos::class, 'ID_NINO', 'ID_NINO');
    }
}
