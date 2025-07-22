<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Representante extends Model
{
    use HasFactory;
    protected $table = 'representante';
    protected $primaryKey = 'ID_REPRESENTANTE';
    public $timestamps = false;


        protected $fillable = [
        'NOMBRE',
        'APELLIDO',
        'EDAD',
        'CELULAR',
        'CEDULA',
        'PARENTEZCO',
        'LUGAR_DE_TRABAJO',
        'GENERO',
    ];

    public function ninos()
    {
        return $this -> belongsToMany(
            Ninos::class,
            'representa',
            'ID_REPRESENTANTE',
            'ID_NINO'
        );
    }
}
