<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProveedoreGatewayController extends BaseGatewayController
{
    /** lista de proveedores */
    public function index()
    {
        return $this->forwardRequest(request(), 'proveedores');
    }
    /**
     * Muestra un planta específico.
     */
    public function show($id)
    {
        return $this->forwardRequest(request(), "proveedores/{$id}");
    }
    /**
     * Crea un nuevo proveedor.
     */
    public function store(Request $request)
    {
        return $this->forwardRequest($request, 'proveedores');
    }
    /**
     * Actualiza un proveedor existente.
     */
    public function update(Request $request, $id)
    {
        return $this->forwardRequest($request, "proveedores/{$id}");
    }
    /**
     * Elimina un proveedor.
     */
    public function destroy(Request $request, $id)
    {
        return $this->forwardRequest($request, "proveedores/{$id}");
    }
}
