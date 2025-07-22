<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GuarderiaController extends Controller
{
    private $url = 'http://127.0.0.1:8001/api';

    public function listarRepresentantes()
    {
        $response = Http::get("{$this->url}/representantes");
        return $response->json();
    }

    public function crearRepresentante(Request $request)
    {
        $response = Http::post("{$this->url}/representantes", $request->all());
        return $response->json();
    }
    public function mostrarRepresentante($id)
    {
        $response = Http::get("{$this->url}/representantes/{$id}");
        return $response->json();
    }
    public function actualizarRepresentante(Request $request, $id)
    {
        $response = Http::put("{$this->url}/representantes/{$id}", $request->all());
        return $response->json();
    }
    public function eliminarRepresentante($id)
    {
        $response = Http::delete("{$this->url}/representantes/{$id}");
        return $response->json();
    }
}
