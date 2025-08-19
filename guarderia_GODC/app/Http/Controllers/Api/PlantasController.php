<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plantas;
use Illuminate\Http\Request;

class PlantasController extends Controller
{
    public function index()
    {
        return Plantas::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NOMBRE' => 'required|string|max:50',
            'ESPECIE' => 'required|string|max:50',
            'TIPO' => 'required|string|max:50',
            'PRECIO' => 'required|numeric|min:0',
            'STOCK' => 'required|integer|min:0',
        ]);

        $planta = Plantas::create($validatedData);

        return response()->json($planta, 201);
    }

    public function show($id)
    {
        return Plantas::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        // 1. Busca el planta o falla (devuelve 404 si no lo encuentra)
        $planta = Plantas::findOrFail($id);

        // 2. Valida los datos que vienen en la petición
        $validatedData = $request->validate([
            'NOMBRE' => 'sometimes|required|string|max:50',
            'ESPECIE' => 'sometimes|required|string|max:50',
            'TIPO' => 'sometimes|required|string|max:50',
            'PRECIO' => 'sometimes|required|numeric|min:0',
            'STOCK' => 'sometimes|required|integer|min:0',
        ]);

        // 3. Si no se envió ningún dato para actualizar, devuelve el registro sin cambios.
        if (empty($validatedData)) {
            return response()->json([
                'message' => 'No se proporcionaron datos para actualizar.',
                'data' => $planta
            ], 200);
        }

        // 4. Actualiza el registro solo con los datos validados
        $planta->update($validatedData);

        // 5. Devuelve el registro actualizado
        return response()->json($planta, 200);
    }

    // Nombre corregido: destroy()
    public function destroy($id)
    {
        plantas::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
