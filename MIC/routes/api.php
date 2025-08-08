<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NinosGatewayController;
use App\Http\Controllers\Api\PacienteGatewayController;
use App\Http\Controllers\Api\GrupoGatewayController;
use App\Http\Controllers\Api\AsistenciaGatewayController;
use App\Http\Controllers\Api\EvaluacionGatewayController;
use App\Http\Controllers\Api\EducadorGatewayController;
use App\Http\Controllers\Api\HorarioGatewayController;
use App\Http\Controllers\Api\ActividadGatewayController;

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    // Rutas del microservicio de pacientes
    Route::apiResource('pacientes', PacienteGatewayController::class);
    Route::apiResource('ninos', NinosGatewayController::class);
    Route::apiResource('grupos', GrupoGatewayController::class);
    Route::apiResource('educadores', EducadorGatewayController::class);
    Route::apiResource('horarios', HorarioGatewayController::class);
    Route::apiResource('actividades', ActividadGatewayController::class);

    Route::get('/grupos/{grupoId}/ninos', [GrupoGatewayController::class, 'listarNinos']);
    Route::post('/grupos/{grupoId}/ninos', [GrupoGatewayController::class, 'asignarNinos']);
    Route::delete('/grupos/{grupoId}/ninos/{ninoId}', [GrupoGatewayController::class, 'quitarNino']);
    // Rutas del microservicio de asistencia
    Route::get('/nino/{ninoId}/asistencia', [AsistenciaGatewayController::class, 'index']);
    Route::post('/nino/{ninoId}/asistencia', [AsistenciaGatewayController::class, 'store']);
    Route::put('/asistencia/{asistenciaId}', [AsistenciaGatewayController::class, 'update']);
    Route::delete('/asistencia/{asistenciaId}', [AsistenciaGatewayController::class, 'destroy']);
    // Rutas del microservicio de evaluaciones
    Route::get('/nino/{ninoId}/evaluaciones', [EvaluacionGatewayController::class, 'index']);
    Route::post('/nino/{ninoId}/evaluaciones', [EvaluacionGatewayController::class, 'store']);
    Route::put('/evaluacion/{evaluacionId}', [EvaluacionGatewayController::class, 'update']);
    Route::delete('/evaluacion/{evaluacionId}', [EvaluacionGatewayController::class, 'destroy']);
});
