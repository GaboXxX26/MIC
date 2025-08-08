<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pagos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // ¡Importante añadir esto!


class PagoController extends Controller
{
    public function index()
    {
        return Pagos::with('representantes')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fecha_pago' => 'required|date',
            'monto' => 'required|numeric',
            'metodo_pago' => 'required|string|max:50',
            'estado' => 'nullable|string|max:100',
        ]);

        $pago = Pagos::create($validatedData);

        return response()->json($pago, 201);
    }

    public function show($id)
    {
        return Pagos::findOrFail($id);
    }

    // Actualizar un pago
    public function update(Request $request, $id)
    {
        $pago = Pagos::findOrFail($id);

        $validatedData = $request->validate([
            'monto' => 'sometimes|required|numeric',
            'fecha_pago' => 'sometimes|required|date',
            'metodo_pago' => 'sometimes|required|string|max:50',
            'estado' => 'nullable|string|max:100',
            
        ]);

        $pago->update($validatedData);

        return response()->json($pago, 200);
    }
    public function destroy($id)
    {
        $pago = Pagos::findOrFail($id);
        $pago->delete();
        return response()->json(null, 204);
    }
}
