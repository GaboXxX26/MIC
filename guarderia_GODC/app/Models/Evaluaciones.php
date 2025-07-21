<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluaciones extends Model
{
    use HasFactory;
    protected $table = 'evaluaciones';
    protected $primaryKey = 'ID_EVALUACION';
    public $timestamps = false;

    public function nino()
    {
        return $this->belongsTo(Ninos::class, 'ID_NINO');
    }
}
