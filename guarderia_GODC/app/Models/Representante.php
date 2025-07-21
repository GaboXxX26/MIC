<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Representante extends Model
{
    use HasFactory;
    protected $table = 'representantes';
    protected $primaryKey = 'ID_REPRESENTANTE';
    public $timestamps = false;

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
