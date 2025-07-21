<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class GuarderiaController extends Controller
{
    public function listarNinos()
    {
        //llamada al enpoint del microservicio de ninos
        $response = Http::get('http://127.0.0.1:8001/api/ninos');

        return $response ->json();
    }
}
