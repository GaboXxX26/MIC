<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EvaluacionGatewayController extends Controller
{
    private $URLevaluaciones = 'http://127.0.0.1:8001/api';

    public function index($ninoId)
    {
        return Http::get("{$this->URLevaluaciones}/nino/{$ninoId}/evaluaciones")
            ->json();
    }

    public function store(Request $request, $ninoId)
    {
        return Http::post("{$this->URLevaluaciones}/nino/{$ninoId}/evaluaciones", $request->all())
            ->json();
    }

    public function update(Request $request, $evaluacionId)
    {
        return Http::put("{$this->URLevaluaciones}/evaluacion/{$evaluacionId}", $request->all())
            ->json();
    }

    public function destroy($evaluacionId)
    {
        $response = Http::delete("{$this->URLevaluaciones}/evaluacion/{$evaluacionId}")
            ->json();

        return response(null, $response->status());
    }
}
