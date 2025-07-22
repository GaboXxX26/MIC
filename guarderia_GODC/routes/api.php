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
    // CRUD para el recurso principal
    Route::apiResource('representantes', RepresentanteController::class);
    Route::apiResource('ninos', NinosController::class);
    Route::apiResource('actividades', ActividadController::class);
    Route::apiResource('horarios', HorarioController::class);
    Route::apiResource('educadores', EducadorController::class);
    Route::apiResource('grupos', GruposController::class);
    //rutas para asistencia
    Route::get('/nino/{ninoId}/asistencia', [AsistenciaController::class, 'index']);
    Route::post('/nino/{ninoId}/asistencia', [AsistenciaController::class, 'store']);
    Route::put('/asistencia/{asistenciaId}', [AsistenciaController::class, 'update']);
    Route::delete('/asistencia/{asistenciaId}', [AsistenciaController::class, 'destroy']);
    //rutas para evaluaciones
    Route::get('/nino/{ninoId}/evaluaciones', [EvaluacionesController::class, 'index']);
    Route::post('/nino/{ninoId}/evaluaciones', [EvaluacionesController::class, 'store']);
    Route::put('/evaluacion/{evaluacionId}', [EvaluacionesController::class, 'update']);
    Route::delete('/evaluacion/{evaluacionId}', [EvaluacionesController::class, 'destroy']);   
    // Rutas para manejar la relación entre un grupo y sus niños
    Route::get('/grupos/{grupo}/ninos', [GruposController::class, 'listarNinos']);
    Route::post('/grupos/{grupo}/ninos', [GruposController::class, 'asignarNinos']);
    Route::delete('/grupos/{grupo}/ninos/{nino}', [GruposController::class, 'quitarNinos']);
});
