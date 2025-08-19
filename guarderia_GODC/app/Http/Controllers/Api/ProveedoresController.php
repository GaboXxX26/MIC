<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    public function index()
    {
        return Proveedores::all();
    }
    //registrar Proveedor
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'DIRECCION' => 'required|string|max:255',
            'CONTACTO' => 'required|string|max:255',
            'PRODUCTOS' => 'required|string|max:255',

        ]);

        $Proveedor = Proveedores::create($validatedData); // Usa el modelo en singular

        return response()->json($Proveedor, 201);
    }
    //ver Proveedor específico
    public function show($id)
    {
        return Proveedores::findOrFail($id);
    }
    //actualizar Proveedore de un niño
    public function update(Request $request, $id)
    {
        $Proveedore = Proveedores::findOrFail($id);
        // 2. Valida solo los campos que se envían en la petición
        $validatedData = $request->validate([
            'NOMBRE' => 'sometimes|required|string|max:255',
            'DIRECCION' => 'sometimes|required|string|max:255',
            'CONTACTO' => 'sometimes|required|string|max:255',
            'PRODUCTOS' => 'sometimes|required|string|max:255',
        ]);

        // 3. Si no se enviaron datos, no hagas nada
        if (empty($validatedData)) {
            return response()->json([
                'message' => 'No se proporcionaron datos para actualizar.',
                'data' => $Proveedore
            ]);
        }

        // 4. Actualiza el Proveedore con los datos validados
        $Proveedore->update($validatedData);

        // 5. Devuelve el Proveedore actualizado
        return response()->json($Proveedore);
    }
    //eliminar Proveedore de un niño
    public function destroy($ProveedoreId)
    {
        $Proveedore = Proveedores::findOrFail($ProveedoreId);
        $Proveedore->delete();
        return response()->json(null, 204);
    }
}
