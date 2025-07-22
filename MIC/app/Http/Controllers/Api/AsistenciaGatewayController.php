<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AsistenciaGatewayController extends Controller
{
    private $URLasistencia = 'http://127.0.0.1:8001/api';

    public function index()
    {
        return Http::get("{$this->URLasistencia}/ninos/{ninoId}/asistencia")
            ->json();
    }

    public function store(Request $request, $ninoId)
    {
        return Http::post("{$this->URLasistencia}/nino/{$ninoId}/asistencia", $request->all())
            ->json();
    }
    public function update(Request $request, $asistenciaId)
    {
        return Http::put("{$this->URLasistencia}/asistencias/{$asistenciaId}", $request->all())
            ->json();
    }

    public function destroy($asistenciaId)
    {
        $response = Http::delete("{$this->URLasistencia}/asistencias/{$asistenciaId}")
            ->json();

        return response(null, $response->status());
    }
}
