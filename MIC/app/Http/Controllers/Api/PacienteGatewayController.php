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
    public function destroy($id)
    {
        // 1. Ejecuta la petición DELETE y guarda el objeto de respuesta COMPLETO
        //    Quitamos el ->json() de esta línea.
        $response = Http::delete("{$this->microserviceUrl}/pacientes/{$id}");

        // 2. Retornamos el cuerpo de la respuesta del microservicio (que puede ser vacío)
        //    y, lo más importante, el CÓDIGO DE ESTADO que sí tiene el objeto $response.
        return response($response->body(), $response->status());
    }
}
