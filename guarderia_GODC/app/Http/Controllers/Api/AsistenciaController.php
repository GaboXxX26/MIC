<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use App\Models\Ninos;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    //obtener asistencia de un niño específico
    public function index($niñoId)
    {
        $nino = Ninos::findOrFail($niñoId);
        return $nino->asistencia;
    }
    //registrar asistencia de un niño
    public function store(Request $request, $niñoId)
    {
        // Verifica que el niño exista
        Ninos::findOrFail($niñoId);

        $validatedData = $request->validate([
            'HORA_ENTRADA' => 'required|date_format:H:i:s',
            'OBSERVACIONES' => 'nullable|string',
        ]);

        // Crea el registro de asistencia
        $asistencia = Asistencia::create([
            'ID_NINO' => $niñoId, // Usa la variable correcta
            'FECHA' => now()->toDateString(),
            'HORA_ENTRADA' => $validatedData['HORA_ENTRADA'],
            // No incluyas HORA_SALIDA aquí, se añadirá después
            'OBSERVACIONES' => $validatedData['OBSERVACIONES'] ?? null,
        ]);

        return response()->json($asistencia, 201);
    }
    //actualizar asistencia para regsitar la salida de un niño
    public function update(Request $request, $asistenciaId)
    {
        // Busca usando la variable corregida
        $asistencia = Asistencia::findOrFail($asistenciaId);

        $validatedData = $request->validate([
            'HORA_SALIDA' => 'required|date_format:H:i:s', // Es buena práctica incluir segundos
            'OBSERVACIONES' => 'nullable|string',
        ]);

        $asistencia->update($validatedData);

        return response()->json($asistencia);
    }

    //eliminar asistencia de un niño
    public function destroy($ID_NINO, $ID_ASISTENCIA)
    {
        $asistencia = Asistencia::findOrFail($ID_ASISTENCIA);
        $asistencia->delete();
        return response()->json(null, 204);
    }
}
