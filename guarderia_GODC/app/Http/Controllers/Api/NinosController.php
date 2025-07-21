<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ninos; 
use Illuminate\Http\Request;

class NinosController extends Controller
{
    public function index()
    {
        return Ninos::all();
    }
}
