<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesiones extends Model
{
    use HasFactory;
    protected $table = 'sesiones';
    protected $primaryKey = 'id_sesion';
    public $timestamps = true;

    protected $fillable = [
        'id_paciente',
        'id_terapeuta',
        'id_terapia',
        'id_pago',
        'fecha_sesion',
        'hora_inicio',
        'hora_fin',
        'observaciones'
    ];
    // Relacion con Paciente
    public function paciente()
    {
        return $this->belongsTo(Pacientes::class, 'id_paciente');
    }
    // Relacion con Terapeuta
    public function terapeuta()
    {
        return $this->belongsTo(Terapeutas::class, 'id_terapeuta');
    }
    // Relacion con Terapia
    public function terapia()
    {
        return $this->belongsTo(Tipos_terapias::class, 'id_terapia');
    }
    // Relacion con Pago
    public function pago()
    {
        return $this->belongsTo(Pagos::class, 'id_pago');
    }

}
