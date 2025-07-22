<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    //ver las actividades
    public function index()
    {
        return Actividad::with('horario')->get();
    }
    //crear una actividad
    public function store(Request $request)
    {
        $actividad = new Actividad();
        $validatedData = $request->validate([
            'NOMBRE' => 'required|string|max:50',
            'DESCRIPCION' => 'nullable|string|max:255',
            'DURACION' => 'required|integer'
        ]);

        $actividad = Actividad::create($validatedData);
        // Si se envían horarios, sincronizarlos
        if ($request->has('horarios_ids')) {
            $actividad->horario()->sync($request->input('horarios_ids'));
        }
        return response()->json($actividad, 201);
    }
    //ver una actividad
    public function show($id)
    {
        return Actividad::with('horario')->findOrFail($id);
    }
    //actualizar una actividad
    public function update(Request $request, $id)
    {
        $actividad = Actividad::findOrFail($id);

        $validatedData = $request->validate([
            'NOMBRE' => 'sometimes|required|string|max:50',
            'DESCRIPCION' => 'sometimes|required|string|max:255',
            'DURACION' => 'sometimes|required|integer',
        ]);

        $actividad->update($validatedData);

        // Si se envían horarios, sincronizarlos
        if ($request->has('horarios_ids')) {
            $actividad->horario()->sync($request->input('horarios_ids'));
        }

        return response()->json($actividad, 200);
    }
    //eliminar una actividad
    public function destroy($id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->delete();
        return response()->json(null, 204);
    }
}
