<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProveedoresController;
use App\Http\Controllers\Api\TerapeutaController;;
use App\Http\Controllers\Api\PagoController;
use App\Http\Controllers\Api\PlantasController;
use App\Http\Controllers\Api\TipoController;
use app\Http\Controllers\Api\UsoController;
use app\Http\Controllers\Api\SesionesController;

Route::middleware('api')->group(function () {
    // CRUD para el recurso principal
    Route::apiResource('plantas', PlantasController::class);
    Route::apiResource('pagos', PagoController::class);
    Route::apiResource('terapeutas', TerapeutaController::class);
    Route::apiResource('proveedores', ProveedoresController::class);
    Route::apiResource('tipos', TipoController::class);
    Route::apiResource('usos', UsoController::class);
    Route::apiResource('sesiones', SesionesController::class);

});
