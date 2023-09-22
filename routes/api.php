<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\MedicalRecordController1 as MedicalRecordService;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// V1
Route::prefix('v1/medical-records')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [MedicalRecordService::class, 'show']); // Listar todos los registros
    Route::get('/{id}', [MedicalRecordService::class, 'index']); // Mostrar un registro específico
    Route::post('/', [MedicalRecordService::class, 'store']); // Crear un nuevo registro
    Route::put('/', [MedicalRecordService::class, 'update']); // Actualizar su registro 
    Route::delete('/{id}', [MedicalRecordService::class, 'destroy']); // Eliminar un registro específico
});



// Authentication Routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'login']); // Login
    Route::post('register', [LoginController::class, 'register']); // Register
    Route::middleware(['auth:sanctum'])->post('logout', [LoginController::class, 'logout']);
});