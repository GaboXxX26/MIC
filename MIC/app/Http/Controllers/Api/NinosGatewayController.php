<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NinosGatewayController extends Controller
{
    private $URLninos = 'http://127.0.0.1:8001/api';

    public function index()
    {
        return Http::get("{$this->URLninos}/ninos")
            ->json();
    }

    public function show($id)
    {
        return Http::get("{$this->URLninos}/ninos/{$id}")
            ->json();
    }

    public function store(Request $request)
    {
        return Http::post("{$this->URLninos}/ninos", $request->all())
            ->json();
    }

    public function update(Request $request, $id)
    {
        return Http::put("{$this->URLninos}/ninos/{$id}", $request->all())
            ->json();
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->URLninos}/ninos/{$id}")
            ->json();

        return response(null, $response->status());
    }
}
