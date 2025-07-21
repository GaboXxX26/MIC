<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Educador;
use Illuminate\Http\Request;

class EducadorController extends Controller
{
    public function index()
    {
        return Educador::all();
    }
}
