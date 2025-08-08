<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pacientes;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        return Pacientes::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|max:10',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|email|max:100',
            'direccion' => 'required|string|max:255'
        ]);

        $paciente = Pacientes::create($validatedData);

        return response()->json($paciente, 201);
    }

    public function show($id)
    {
        return Pacientes::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        // 1. Busca el paciente o falla (devuelve 404 si no lo encuentra)
        $paciente = Pacientes::findOrFail($id);

        // 2. Valida los datos que vienen en la petición
        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:50',
            'apellido' => 'sometimes|required|string|max:50',
            'fecha_nacimiento' => 'sometimes|required|date',
            'sexo' => 'sometimes|required|string|max:10',
            'telefono' => 'sometimes|required|string|max:15',
            'correo' => 'sometimes|required|email|max:100',
            'direccion' => 'sometimes|required|string|max:255',
        ]);

        // 3. Si no se envió ningún dato para actualizar, devuelve el registro sin cambios.
        if (empty($validatedData)) {
            return response()->json([
                'message' => 'No se proporcionaron datos para actualizar.',
                'data' => $paciente
            ], 200);
        }

        // 4. Actualiza el registro solo con los datos validados
        $paciente->update($validatedData);

        // 5. Devuelve el registro actualizado
        return response()->json($paciente, 200);
    }

    // Nombre corregido: destroy()
    public function destroy($id)
    {
        Pacientes::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
