<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sesiones;
use Illuminate\Http\Request;

class SesionesController extends Controller
{
    //obtener asistencia de un niño específico
    public function index()
    {
        return Sesiones::all();
    }
    //registrar asistencia de un niño
    public function store(Request $request, $niñoId)
    {
        $validatedData = $request->validate([
            'id_paciente' => 'required|integer|exists:pacientes,id',
            'id_terapeuta' => 'required|integer|exists:terapeutas,id',
            'id_terapia' => 'required|integer|exists:terapias,id',
            'id_pago' => 'required|integer|exists:pago,id',
            'fecha_sesion' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s',
            'observaciones' => 'nullable|string',
        ]);

        $sesion = Sesiones::create($validatedData);
        return response()->json($sesion, 201);
    }
    //actualizar asistencia para regsitar la salida de un niño
    public function update(Request $request, $asistenciaId)
    {
        // Busca usando la variable corregida
        $sesion = Sesiones::findOrFail($asistenciaId);

        $validatedData = $request->validate([
            'id_paciente' => 'required|integer|exists:pacientes,id',
            'id_terapeuta' => 'required|integer|exists:terapeutas,id',
            'id_terapia' => 'required|integer|exists:terapias,id',
            'id_pago' => 'required|integer|exists:pago,id',
            'fecha_sesion' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s',
            'observaciones' => 'nullable|string',
        ]);

        $sesion->update($validatedData);

        return response()->json($sesion);
    }

    //eliminar asistencia de un niño
    public function destroy($ID_NINO, $ID_ASISTENCIA)
    {
        $sesion = Sesiones::findOrFail($ID_ASISTENCIA);
        $sesion->delete();
        return response()->json(null, 204);
    }
}
