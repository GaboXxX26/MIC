<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EducadorGatewayController extends Controller
{
    private $URLeducador = 'http://127.0.0.1:8001/api';

    public function index()
    {
        return Http::get("{$this->URLeducador}/educadores")
            ->json();
    }

    public function store(Request $request)
    {
        return Http::post("{$this->URLeducador}/educadores", $request->all())
            ->json();
    }

    public function update(Request $request, $educadorId)
    {
        return Http::put("{$this->URLeducador}/educadores/{$educadorId}", $request->all())
            ->json();
    }

    public function destroy($educadorId)
    {
        $response = Http::delete("{$this->URLeducador}/educadores/{$educadorId}")
            ->json();

        return response(null, $response->status());
    }
}
