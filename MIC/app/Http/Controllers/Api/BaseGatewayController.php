<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;

class BaseGatewayController extends Controller
{
     /**
     * URL base del microservicio.
     */
    protected $microserviceUrl;

    public function __construct()
    {
        $this->microserviceUrl = 'http://127.0.0.1:8001/api';
    }

    /**
     * Reenvía una petición al microservicio, añadiendo la cabecera del rol.
     */
    protected function forwardRequest(Request $request, $endpoint)
    {
        // --- ESTA ES LA PARTE CORREGIDA ---
        // 1. Obtenemos el payload (los datos) del token actual.
        $payload = JWTAuth::parseToken()->getPayload();

        // 2. Obtenemos el rol desde el payload.
        $role = $payload->get('role');
        // --- FIN DE LA CORRECCIÓN ---


        // 3. Construimos la URL completa
        $url = "{$this->microserviceUrl}/{$endpoint}";
        
        // 4. Hacemos la petición con el método, datos y cabecera correctos
        $response = Http::withHeaders(['X-User-Role' => $role])
            ->send($request->method(), $url, [
                'json' => $request->all()
            ]);

        // 5. Devolvemos la respuesta del microservicio (cuerpo y estado)
        return response($response->body(), $response->status());
    }
}
