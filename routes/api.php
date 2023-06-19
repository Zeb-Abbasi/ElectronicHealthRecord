<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('admin')->group(function () {
    //Doctors Routes
    Route::post('/create-doctor', [DoctorController::class, 'createDoctor']);



    //Patient Routes
    Route::post('/create-patient', [PatientController::class, 'createPatient']);
});

// Route::post('/admin-login', [AuthController::class, 'adminLogin']);


