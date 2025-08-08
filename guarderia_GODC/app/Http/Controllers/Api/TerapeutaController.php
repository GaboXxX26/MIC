<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Terapeutas;
use Illuminate\Http\Request;

class TerapeutaController extends Controller
{
    // Listar todos los terapeutas
    public function index()
    {
        return Terapeutas::all();
    }
    // crear un nuevo terapeuta
    public function store(Request $request)
    {
        // Valida los datos aceptando el formato con segundos (H:i:s)
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'especialidad' => 'required|string|max:100',
            'telefono' => 'required|string|max:15',
            'correo' => 'required|email|max:100',
        ]);

        $terapeuta = Terapeutas::create($validatedData);

        return response()->json($terapeuta, 201);
    }
    // mostrar un terapeuta específico
    public function show($id)
    {
        return Terapeutas::findOrFail($id);
    }
    // actualizar un terapeuta específico
    public function update(Request $request, $id)
    {
        $terapeuta = Terapeutas::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'especialidad' => 'sometimes|required|string|max:100',
            'telefono' => 'sometimes|required|string|max:15',
            'correo' => 'sometimes|required|email|max:100',
        ]);

        $terapeuta->update($validatedData);

        return response()->json($terapeuta, 200 );
    }
   
    public function destroy($id)
    {
        $terapeuta = Terapeutas::findOrFail($id);
        $terapeuta->delete();

        return response()->json(null, 204);
    }
}
