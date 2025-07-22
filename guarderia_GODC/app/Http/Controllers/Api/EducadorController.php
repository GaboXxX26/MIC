<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Educador;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // ¡Importante añadir esto!

class EducadorController extends Controller
{
    //ver los educadores
    public function index()
    {
        return Educador::all();
    }
    // crear educador
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NOMBRE' => 'required|string|max:50',
            'APELLIDO' => 'required|string|max:50',
            'CEDULA' => 'required|string|max:10|unique:EDUCADOR,CEDULA',
            'ESPECIALIDAD' => 'required|string|max:50',
            'CELULAR' => 'required|string|max:10',
            'EDAD' => 'required|integer|min:18',
        ]);
        $educador = Educador::create($validatedData);
        return response()->json($educador, 201);
    }
    //ver un educador
    public function show($id)
    {
        return Educador::findOrFail($id);
    }
    //actualizar educador
    public function update(Request $request, $id)
    {
        $educador = Educador::findOrFail($id);
        $validatedData = $request->validate([
            'NOMBRE' => 'required|string|max:50',
            'APELLIDO' => 'required|string|max:50',
            'CEDULA' => [
                'sometimes',
                'required',
                'string',
                'max:10',
                Rule::unique('educador', 'CEDULA')->ignore($educador->ID_EDUCADORA, 'ID_EDUCADORA')
            ],
            'ESPECIALIDAD' => 'sometimes|string|max:50',
            'CELULAR' => 'sometimes|string|max:10',
            'EDAD' => 'sometimes|integer|min:18',

        ]);

        if (empty($validatedData)) {
            return response()->json([
                'message' => 'No se proporcionaron datos para actualizar.',
                'data' => $educador
            ], 200);
        }

        $educador->update($validatedData);
        return response()->json($educador, 200);
    }
    //eliminar educador
    public function destroy($id)
    {
        Educador::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Educador eliminado correctamente.'
        ], 204);
    }
}
