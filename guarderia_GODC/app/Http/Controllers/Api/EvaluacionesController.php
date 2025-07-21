<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluaciones;
use Illuminate\Http\Request;

class EvaluacionesController extends Controller
{
    public function index()
    {
        return Evaluaciones::all();
    }
}
