<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PatientController;

// Route::apiResource('patients', PatientController::class);

// Route::get('patients/create', [PatientController::class, 'createFromQuery']);

Route::post('patients', [PatientController::class, 'store']);
Route::get('patients', [PatientController::class, 'index']);
Route::get('patients/{id}', [PatientController::class, 'show']);
Route::put('patients/{id}', [PatientController::class, 'update']);
Route::delete('patients/{id}', [PatientController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
