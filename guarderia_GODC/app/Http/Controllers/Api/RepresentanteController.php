<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Representante;
use Illuminate\Http\Request;

class RepresentanteController extends Controller
{
    public function index()
    {
        return Representante::all();
    }
}
