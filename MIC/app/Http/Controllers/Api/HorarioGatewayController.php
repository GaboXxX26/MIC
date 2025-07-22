<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HorarioGatewayController extends Controller
{
    private $URLhorario = 'http://127.0.0.1:8001/api';

    public function index()
    {
        return Http::get("{$this->URLhorario}/horarios")
            ->json();
    }

    public function store(Request $request)
    {
        return Http::post("{$this->URLhorario}/horarios", $request->all())
            ->json();
    }

    public function update(Request $request, $horarioId)
    {
        return Http::put("{$this->URLhorario}/horarios/{$horarioId}", $request->all())
            ->json();
    }

    public function destroy($horarioId)
    {
        $response = Http::delete("{$this->URLhorario}/horarios/{$horarioId}")
            ->json();

        return response(null, $response->status());
    }
}
