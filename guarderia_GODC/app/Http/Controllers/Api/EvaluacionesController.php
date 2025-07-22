<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluaciones;
use App\Models\Ninos;
use Illuminate\Http\Request;

class EvaluacionesController extends Controller
{
    //onbtener evaluaciones de un niño específico
    public function index($ninoId)
    {
        $nino = Ninos::findOrFail($ninoId);
        return $nino->evaluaciones;
    }
    //registrar evaluación de un niño
    public function store(Request $request, $ninoId)
    {
        // 1. Verifica que el niño exista (usa el modelo en singular por convención)
        Ninos::findOrFail($ninoId);

        // 2. Valida solo los datos que vienen del usuario
        $validatedData = $request->validate([
            'AREA_DESARROLLO' => 'required|string',
            'DESCRIPCION' => 'required|string',
            'NOTA' => 'required|numeric|min:0|max:10', // Ajusta el máximo si es necesario
        ]);

        // 3. Añade los datos que genera el servidor (ID y Fecha)
        $dataToCreate = array_merge($validatedData, [
            'ID_NINO' => $ninoId,
            'FECHA' => now()->toDateString() // La fecha se asigna aquí
        ]);

        // 4. Crea la evaluación
        $evaluacion = Evaluaciones::create($dataToCreate); // Usa el modelo en singular

        return response()->json($evaluacion, 201);
    }
    //actualizar evaluación de un niño
    public function update(Request $request, $evaluacionId)
    {
        // 1. Busca la evaluación o falla si no la encuentra
        $evaluacion = Evaluaciones::findOrFail($evaluacionId); // Usa el modelo en singular

        // 2. Valida solo los campos que se envían en la petición
        $validatedData = $request->validate([
            'FECHA' => 'sometimes|required|date',
            'AREA_DESARROLLO' => 'sometimes|required|string',
            'DESCRIPCION' => 'sometimes|required|string',
            'NOTA' => 'sometimes|required|numeric|min:0|max:10',
        ]);

        // 3. Si no se enviaron datos, no hagas nada
        if (empty($validatedData)) {
            return response()->json([
                'message' => 'No se proporcionaron datos para actualizar.',
                'data' => $evaluacion
            ]);
        }

        // 4. Actualiza la evaluación con los datos validados
        $evaluacion->update($validatedData);

        // 5. Devuelve la evaluación actualizada
        return response()->json($evaluacion);
    }
    //eliminar evaluación de un niño
    public function destroy($evaluacionId)
    {
        $evaluacion = Evaluaciones::findOrFail($evaluacionId);
        $evaluacion->delete();
        return response()->json(null, 204);
    }
}
