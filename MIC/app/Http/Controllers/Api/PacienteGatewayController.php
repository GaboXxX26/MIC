<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PacienteGatewayController extends BaseGatewayController
{
    /** lista de pacientes */
    public function index()
    {
        return $this->forwardRequest(request(), 'pacientes');
    }
    /**
     * Muestra un paciente específico.
     */
    public function show($id)
    {
        return $this->forwardRequest(request(), "pacientes/{$id}");
    }
    /**
     * Crea un nuevo paciente.
     */
    public function store(Request $request)
    {
        return $this->forwardRequest($request, 'pacientes');
    }
    /**
     * Actualiza un paciente existente.
     */
    public function update(Request $request, $id)
    {
        return $this->forwardRequest($request, "pacientes/{$id}");
    }
    /**
     * Elimina un paciente.
     */
    public function destroy(Request $request, $id)
    {
        return $this->forwardRequest($request, "pacientes/{$id}");
    }
}
