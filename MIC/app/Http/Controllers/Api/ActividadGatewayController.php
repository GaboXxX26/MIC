<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActividadGatewayController extends Controller
{
    private $URLactividad = 'http://127.0.0.1:8001/api';

    public function index()
    {
        return Http::get("{$this->URLactividad}/actividades")
            ->json();
    }

    public function store(Request $request)
    {
        return Http::post("{$this->URLactividad}/actividades", $request->all())
            ->json();
    }

    public function update(Request $request, $actividadId)
    {
        return Http::put("{$this->URLactividad}/actividades/{$actividadId}", $request->all())
            ->json();
    }

    public function destroy($actividadId)
    {
        $response = Http::delete("{$this->URLactividad}/actividades/{$actividadId}")
            ->json();

        return response(null, $response->status());
    }
}
