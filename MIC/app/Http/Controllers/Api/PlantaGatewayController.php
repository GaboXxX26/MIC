<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlantaGatewayController extends BaseGatewayController
{
    /** lista de plantas */
    public function index()
    {
        return $this->forwardRequest(request(), 'plantas');
    }
    /**
     * Muestra un planta específico.
     */
    public function show($id)
    {
        return $this->forwardRequest(request(), "plantas/{$id}");
    }
    /**
     * Crea un nuevo planta.
     */
    public function store(Request $request)
    {
        return $this->forwardRequest($request, 'plantas');
    }
    /**
     * Actualiza un planta existente.
     */
    public function update(Request $request, $id)
    {
        return $this->forwardRequest($request, "plantas/{$id}");
    }
    /**
     * Elimina un planta.
     */
    public function destroy(Request $request, $id)
    {
        return $this->forwardRequest($request, "plantas/{$id}");
    }
}
