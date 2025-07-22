<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Representante;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // ¡Importante añadir esto!

class RepresentanteController extends Controller
{
    public function index()
    {
        return Representante::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NOMBRE' => 'required|string|max:50',
            'APELLIDO' => 'required|string|max:50',
            'EDAD' => 'required|integer|min:18',
            'CELULAR' => 'required|string|max:10',
            'CEDULA' => 'required|string|max:10|unique:REPRESENTANTE,CEDULA',
            'PARENTEZCO' => 'required|string|max:50',
            'LUGAR_DE_TRABAJO' => 'required|string|max:500',
            'GENERO' => 'required|string|max:10',
        ]);

        $representante = Representante::create($validatedData);

        return response()->json($representante, 201);
    }

    public function show($id)
    {
        return Representante::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        // 1. Busca el representante o falla (devuelve 404 si no lo encuentra)
        $representante = Representante::findOrFail($id);

        // 2. Valida los datos que vienen en la petición
        $validatedData = $request->validate([
            'NOMBRE' => 'sometimes|required|string|max:50',
            'APELLIDO' => 'sometimes|required|string|max:50',
            'EDAD' => 'sometimes|required|integer|min:18',
            'CELULAR' => 'sometimes|required|string|max:10',
            'CEDULA' => [
                'sometimes',
                'required',
                'string',
                'max:10',
                Rule::unique('REPRESENTANTE', 'CEDULA')->ignore($representante->ID_REPRESENTANTE, 'ID_REPRESENTANTE')
            ],
            'PARENTEZCO' => 'sometimes|required|string|max:50',
            '_LUGAR_DE_TRABAJO__' => 'sometimes|required|string|max:500',
            'GENERO' => 'sometimes|required|string|max:10',
        ]);

        // 3. Si no se envió ningún dato para actualizar, devuelve el registro sin cambios.
        if (empty($validatedData)) {
            return response()->json([
                'message' => 'No se proporcionaron datos para actualizar.',
                'data' => $representante
            ], 200);
        }

        // 4. Actualiza el registro solo con los datos validados
        $representante->update($validatedData);

        // 5. Devuelve el registro actualizado
        return response()->json($representante, 200);
    }

    // Nombre corregido: destroy()
    public function destroy($id)
    {
        Representante::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
