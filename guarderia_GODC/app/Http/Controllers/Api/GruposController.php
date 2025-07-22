<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grupos;
use App\Models\Ninos;
use Illuminate\Http\Request;
use Illuminate\Support\Arr; // Importa Arr para manipular arrays

class GruposController extends Controller
{
    //ver los grupos
    public function index()
    {
        return Grupos::all();
    }
    // crear un grupo
    public function store(Request $request)
    {
        // 1. La validación está bien como la tienes
        $validatedData = $request->validate([
            'ID_EDUCADORA' => 'required|exists:EDUCADOR,ID_EDUCADORA',
            'ID_ACTIVIDAD' => 'required|exists:ACTIVIDAD,ID_ACTIVIDAD',
            'NOMBRE' => 'required|string|max:50',
            'UBICACION' => 'required|string',
            'ninos_ids' => 'sometimes|array',
            'ninos_ids.*' => 'exists:NINOS,ID_NINO'
        ]);

        // --- ESTE ES EL CAMBIO MÁS IMPORTANTE ---
        // 2. Crea el grupo usando SOLAMENTE los datos de su tabla
        $grupo = Grupos::create(
            Arr::except($validatedData, ['ninos_ids'])
        );

        // 3. Si se enviaron IDs de niños, adjúntalos al grupo recién creado
        if (isset($validatedData['ninos_ids'])) {
            $grupo->ninos()->attach($validatedData['ninos_ids']);
        }

        // 4. Devuelve el grupo con los niños cargados
        return response()->json($grupo->load('ninos'), 201);
    }
    //ver un grupo
    public function show($id)
    {
        return Grupos::with('ninos')->findOrFail($id);
    }
    //actualizar un grupo
    public function update(Request $request, $id)
    {
        $grupo = Grupos::findOrFail($id);
        $validatedData = $request->validate([
            'ID_EDUCADORA' => 'required|exists:EDUCADOR,ID_EDUCADORA',
            'ID_ACTIVIDAD' => 'required|exists:ACTIVIDAD,ID_ACTIVIDAD',
            'NOMBRE' => 'required|string|max:50',
            'UBICACION' => 'required|string|max:100',
            'ninos_ids' => 'sometimes|array',
            'ninos_ids.*' => 'exists:NINOS,ID_NINO'
        ]);
        $grupo->update($validatedData);
        if ($request->has('ninos_ids')) {
            $grupo->ninos()->sync($validatedData['ninos_ids']);
        }
        return response()->json($grupo->load('ninos'), 200);
    }
    //eliminar un grupo
    public function destroy($id)
    {
        $grupo = Grupos::findOrFail($id);
        $grupo->delete();
        return response()->json(null, 204);
    }
    //funciones para intercatuar con los ninos dentro del grupo 
    //listar los niños de un grupo
    public function listarNinos($grupoId)
    {
        $grupo = Grupos::with('ninos')->findOrFail($grupoId);
        return response()->json($grupo->ninos, 200);
    }

    //asignar niños a un grupo
    public function asignarNinos(Request $request, Grupos $grupo)
    {
        $validated = $request->validate([
            'ninos_ids' => 'required|array',
            'ninos_ids.*' => 'exists:NINOS,ID_NINO'
        ]);

        // sync() es ideal: añade los nuevos y mantiene los existentes.
        // Si quieres solo añadir sin borrar los anteriores, usa attach().
        $grupo->ninos()->syncWithoutDetaching($validated['ninos_ids']);

        // Devuelve la lista actualizada de niños en el grupo.
        return response()->json($grupo->load('ninos'));
    }
    //quitar un niño de un grupo
    public function quitarNino(Grupos $grupo, Ninos $nino)
    {
        // El método detach() elimina el registro de la tabla intermedia.
        $grupo->ninos()->detach($nino->ID_NINO);

        return response()->json(['message' => 'Niño eliminado del grupo exitosamente.']);
    }
}
