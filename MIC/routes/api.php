<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PacienteGatewayController;

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    // Rutas del microservicio de pacientes
    Route::apiResource('pacientes', PacienteGatewayController::class);

});


