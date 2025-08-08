<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grupos;
use App\Models\Tipos_terapias;
use Illuminate\Http\Request;
use Illuminate\Support\Arr; // Importa Arr para manipular arrays

class TipoController extends Controller
{
    //ver los grupos
    public function index()
    {
        return Tipos_terapias::all();
    }
    // crear un grupo
    public function store(Request $request)
    {
        // 1. La validación está bien como la tienes
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'duracion_aproximada' => 'required|integer|min:1',
            'costo_base' => 'required|numeric|min:0',
        ]);

        // 2. Crea el grupo usando SOLAMENTE los datos de su tabla
        $tipo = Tipos_terapias::create($validatedData);

        return response()->json($tipo, 201);
    }
    //ver un grupo
    public function show($id)
    {
        return Tipos_terapias::findOrFail($id);
    }
    //actualizar un grupo
    public function update(Request $request, $id)
    {
        $tipo = Tipos_terapias::findOrFail($id);
        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:50',
            'descripcion' => 'sometimes|required|string|max:255',
            'duracion_aproximada' => 'sometimes|required|integer|min:1',
            'costo_base' => 'sometimes|required|numeric|min:0',
        ]);
        $tipo->update($validatedData);
        return response()->json($tipo, 200);
    }
    //eliminar un grupo
    public function destroy($id)
    {
        $tipo = Tipos_terapias::findOrFail($id);
        $tipo->delete();
        return response()->json(null, 204);
    }

}
