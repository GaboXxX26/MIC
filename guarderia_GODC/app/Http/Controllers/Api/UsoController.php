<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Uso_productos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // ¡Importante añadir esto!

class UsoController extends Controller
{
    //ver los usos de productos
    public function index()
    {
        return Uso_productos::all();
    }
    // crear uso de producto
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_sesion' => 'required|integer|exists:sesiones,id',
            'id_producto' => 'required|integer|exists:productos,id',
            'cantidad_utilizada' => 'required|integer|min:1',
            'observaciones' => 'sometimes|string|max:255',
        ]);
        $uso = Uso_productos::create($validatedData);
        return response()->json($uso, 201);
    }
    //ver un uso de producto
    public function show($id)
    {
        return Uso_productos::findOrFail($id);
    }
    //actualizar uso de producto
    public function update(Request $request, $id)
    {
        $uso = Uso_productos::findOrFail($id);
        $validatedData = $request->validate([
            'id_sesion' => 'sometimes|integer|exists:sesiones,id',
            'id_producto' => 'sometimes|integer|exists:productos,id',
            'cantidad_utilizada' => 'sometimes|integer|min:1',
            'observaciones' => 'sometimes|string|max:255',
        ]);

        if (empty($validatedData)) {
            return response()->json([
                'message' => 'No se proporcionaron datos para actualizar.',
                'data' => $uso
            ], 200);
        }

        $uso->update($validatedData);
        return response()->json($uso, 200);
    }
    //eliminar uso de producto
    public function destroy($id)
    {
        Uso_productos::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Uso de producto eliminado correctamente.'
        ], 204);
    }
}
