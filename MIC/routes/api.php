<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlantaGatewayController;
use App\Http\Controllers\Api\ProveedoreGatewayController;


Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    // Rutas del microservicio de plantas
    Route::apiResource('plantas', PlantaGatewayController::class);
    Route::apiResource('proveedores', ProveedoreGatewayController::class);

});


