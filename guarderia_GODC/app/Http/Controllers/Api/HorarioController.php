<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    // Listar todos los horarios
    public function index()
    {
        return Horario::all();
    }
    // crear un nuevo horario
    public function store(Request $request)
    {
        // Valida los datos aceptando el formato con segundos (H:i:s)
        $validatedData = $request->validate([
            'HORA_INICIO' => 'required|date_format:H:i',
            'HORA_FIN' => 'required|date_format:H:i|after:HORA_INICIO',
        ]);

        // Esta parte ya sabemos que funciona
        $horario = Horario::create($validatedData);

        return response()->json($horario, 201);
    }
    // mostrar un horario específico
    public function show($id)
    {
        return Horario::findOrFail($id);
    }
    // actualizar un horario específico
    public function update(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);

        $validatedData = $request->validate([
            'HORA_INICIO' => 'sometimes|required|date_format:H:i',
            'HORA_FIN' => 'sometimes|required|date_format:H:i|after:HORA_INICIO',
        ]);

        $horario->update($validatedData);

        return response()->json($horario, 200);
    }
    // eliminar un horario específico
    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();

        return response()->json(null, 204);
    }
}
