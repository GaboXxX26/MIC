<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RepresentanteGatewayController extends BaseGatewayController
{
    /** lista de representantes */
    public function index()
    {
        return $this->forwardRequest(request(), 'representantes');
    }
    /**
     * Muestra un representante específico.
     */
    public function show($id)
    {
        return $this->forwardRequest(request(), "representantes/{$id}");
    }
    /**
     * Crea un nuevo representante.
     */
    public function store(Request $request)
    {
        return $this->forwardRequest($request, 'representantes');
    }
    /**
     * Actualiza un representante existente.
     */
    public function update(Request $request, $id)
    {
        return $this->forwardRequest($request, "representantes/{$id}");
    }
    /**
     * Elimina un representante.
     */
    public function destroy($id)
    {
        // 1. Ejecuta la petición DELETE y guarda el objeto de respuesta COMPLETO
        //    Quitamos el ->json() de esta línea.
        $response = Http::delete("{$this->microserviceUrl}/representantes/{$id}");

        // 2. Retornamos el cuerpo de la respuesta del microservicio (que puede ser vacío)
        //    y, lo más importante, el CÓDIGO DE ESTADO que sí tiene el objeto $response.
        return response($response->body(), $response->status());
    }
}
