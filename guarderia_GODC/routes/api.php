<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GruposController;
use App\Http\Controllers\Api\EvaluacionesController;
use App\Http\Controllers\Api\EducadorController;
use App\Http\Controllers\Api\AsistenciaController;
use App\Http\Controllers\Api\HorarioController;
use App\Http\Controllers\Api\RepresentanteController;
use App\Http\Controllers\Api\ActividadController;
use App\Http\Controllers\Api\NinosController;



Route::middleware('api')->group(function () {
    Route::get('/grupos', [GruposController::class, 'index']);
    Route::get('/evaluaciones', [EvaluacionesController::class, 'index']);
    Route::get('/educadores', [EducadorController::class, 'index']);
    Route::get('/asistencia', [AsistenciaController::class, 'index']);
    Route::get('/horarios', [HorarioController::class, 'index']);
    Route::apiResource('representantes', RepresentanteController::class);
    Route::get('/actividades', [ActividadController::class, 'index']);
    Route::apiResource('ninos', NinosController::class);
});
