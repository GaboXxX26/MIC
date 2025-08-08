<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Productos;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //onbtener productos de un niño específico
    public function index()
    {
        return Productos::all();
    }
    //registrar producto de un niño
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'stock_actual' => 'required|numeric|min:0',
            'precio_unitario' => 'required|integer|min:0',
            'tipo_producto' => 'required|string|max:255'
        ]);


        // 4. Crea el producto
        $producto = Productos::create($validatedData); // Usa el modelo en singular

        return response()->json($producto, 201);
    }
    //ver producto específico
    public function show($id)
    {
        return Productos::findOrFail($id);
    }
    //actualizar producto de un niño
    public function update(Request $request, $id)
    {
        $producto = Productos::findOrFail($id);
        // 2. Valida solo los campos que se envían en la petición
        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string|max:255',
            'stock_actual' => 'sometimes|required|numeric|min:0',
            'precio_unitario' => 'sometimes|required|integer|min:0',
            'tipo_producto' => 'sometimes|required|string|max:255'
        ]);

        // 3. Si no se enviaron datos, no hagas nada
        if (empty($validatedData)) {
            return response()->json([
                'message' => 'No se proporcionaron datos para actualizar.',
                'data' => $producto
            ]);
        }

        // 4. Actualiza el producto con los datos validados
        $producto->update($validatedData);

        // 5. Devuelve el producto actualizado
        return response()->json($producto);
    }
    //eliminar producto de un niño
    public function destroy($productoId)
    {
        $producto = Productos::findOrFail($productoId);
        $producto->delete();
        return response()->json(null, 204);
    }
}
