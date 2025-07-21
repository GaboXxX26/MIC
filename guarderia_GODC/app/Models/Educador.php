<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educador extends Model
{
    use HasFactory;
    protected $table = 'educadores';
    protected $primaryKey = 'ID_EDUCADOR';
    public $timestamps = false;

    public function grupos()
    {
        return $this->hasMany(Grupos::class, 
            'ID_EDUCADOR'
        );
    }

}
