<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ninos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // ¡Importante añadir esto!


class NinosController extends Controller
{
    public function index()
    {
        return Ninos::with('representantes')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NOMBRE' => 'required|string|max:50',
            'APELLIDO' => 'required|string|max:50',
            'EDAD' => 'required|integer',
            'GENERO' => 'required|string|max:10',
            'CEDULA' => 'required|string|max:10|unique:NINOS,CEDULA',
            'ALERGIAS' => 'required|string',
            'ENFERMEDADES' => 'required|string',
            'OBSERVACIONES' => 'nullable|string',
            'DIRECCION' => 'nullable|string|max:100',
            'representantes_ids' => 'sometimes|array',
            'representantes_ids.*' => 'exists:REPRESENTANTE,ID_REPRESENTANTE'
        ]);

        $nino = Ninos::create($validatedData);

        // Sincronizar los representantes
        if ($request->has('representantes_ids')) {
            $nino->representantes()->sync($request->input('representantes_ids'));
        }

        return response()->json($nino, 201);
    }

    public function show($id)
    {
        return Ninos::with('representantes')->findOrFail($id);
    }
    // Actualizar un niño
    public function update(Request $request, $id)
    {
        $nino = Ninos::findOrFail($id);

        $validatedData = $request->validate([
            'NOMBRE' => 'sometimes|required|string|max:50',
            'APELLIDO' => 'sometimes|required|string|max:50',
            'EDAD' => 'sometimes|required|integer',
            'GENERO' => 'sometimes|required|string|max:10',
            'CEDULA' => [
                'sometimes',
                'required',
                'string',
                'max:10',
                Rule::unique('NINOS', 'CEDULA')->ignore($nino->ID_NINO, 'ID_NINO')
            ],
            'ALERGIAS' => 'sometimes|required|string',
            'ENFERMEDADES' => 'sometimes|required|string',
            'OBSERVACIONES' => 'sometimes|nullable|string',
            'DIRECCION' => 'sometimes|nullable|string|max:100',
            'representantes_ids' => 'sometimes|array',
            'representantes_ids.*' => 'exists:REPRESENTANTE,ID_REPRESENTANTE'
        ]);

        $nino->update($validatedData);

        // Sincronizar los representantes
        if ($request->has('representantes_ids')) {
            $nino->representantes()->sync($request->input('representantes_ids'));
        }

        return response()->json($nino, 200);
    }

    public function destroy($id)
    {
        $nino = Ninos::findOrFail($id);
        $nino->delete();
        return response()->json(null, 204);
    }
}
