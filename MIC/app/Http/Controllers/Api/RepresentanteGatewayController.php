<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RepresentanteGatewayController extends Controller
{
    private $URLrepresentante = 'http://127.0.0.1:8001/api';

    public function index()
    {
        return Http::get("{$this->URLrepresentante}/representantes")
            ->json();
    }

    public function show($id)
    {
        return Http::get("{$this->URLrepresentante}/representantes/{$id}")
            ->json();
    }

    public function store(Request $request)
    {
        return Http::post("{$this->URLrepresentante}/representantes", $request->all())
            ->json();
    }

    public function update(Request $request, $id)
    {
        return Http::put("{$this->URLrepresentante}/representantes/{$id}", $request->all())
            ->json();
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->URLrepresentante}/representantes/{$id}")
            ->json();

        return response(null, $response->status());
    }
}
