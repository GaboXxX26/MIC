<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grupos;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    public function index()
    {
        return Grupos::all();
    }
}
