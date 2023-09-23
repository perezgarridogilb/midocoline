<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\BeneficiaryController;
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
    Route::delete('/', [MedicalRecordService::class, 'destroy']); // Eliminar su registro
});


Route::prefix('v1/beneficiaries')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [BeneficiaryController::class, 'store']); // Crear un beneficiario asociado al titular
    Route::get('/', [BeneficiaryController::class, 'show']); // Listar todos los beneficiarios
    Route::delete('/{id}', [BeneficiaryController::class, 'destroy']); // Eliminar un beneficiario
});

// Authentication Routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']); // Login
    Route::post('register', [AuthController::class, 'register']); // Register
    Route::middleware(['auth:sanctum'])->post('logout', [AuthController::class, 'logout']);
});