<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GrupoGatewayController extends Controller
{
    private $URLgrupos = 'http://127.0.0.1:8001/api';

    public function index()
    {
        return Http::get("{$this->URLgrupos}/grupos")
            ->json();
    }

    public function show($id)
    {
        return Http::get("{$this->URLgrupos}/grupos/{$id}")
            ->json();
    }

    public function store(Request $request)
    {
        return Http::post("{$this->URLgrupos}/grupos", $request->all())
            ->json();
    }

    public function update(Request $request, $id)
    {
        return Http::put("{$this->URLgrupos}/grupos/{$id}", $request->all())
            ->json();
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->URLgrupos}/grupos/{$id}")
            ->json();

        return response(null, $response->status());
    }

    public function listarNiños($grupoId)
    {
        return Http::get("{$this->URLgrupos}/grupos/{$grupoId}/niños")->json();
    }

    public function asignarNiños(Request $request, $grupoId)
    {
        return Http::post("{$this->URLgrupos}/grupos/{$grupoId}/niños", $request->all())->json();
    }

    public function quitarNiño($grupoId, $niñoId)
    {
        $response = Http::delete("{$this->URLgrupos}/grupos/{$grupoId}/niños/{$niñoId}");
        return response(null, $response->status());
    }
}
