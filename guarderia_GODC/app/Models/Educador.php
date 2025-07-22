<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educador extends Model
{
    use HasFactory;
    protected $table = 'educador';
    protected $primaryKey = 'ID_EDUCADORA';
    public $timestamps = false;

    protected $fillable = [
        'NOMBRE',
        'APELLIDO',
        'CEDULA',
        'ESPECIALIDAD',
        'CELULAR',
        'EDAD',
    ];

    public function grupos()
    {
        return $this->hasMany(
            Grupos::class,
            'ID_EDUCADORA'
        );
    }
}
