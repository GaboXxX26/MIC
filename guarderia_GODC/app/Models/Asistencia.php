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

    public function nino()
    {
        return $this->belongsTo(Ninos::class, 'ID_NINO');
    }


}
