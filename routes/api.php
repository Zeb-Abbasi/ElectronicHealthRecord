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

// Route::middleware('admin')->group(function () {

    //Doctors Routes
    Route::get('/get-doctor', [DoctorController::class, 'getDoctor']);
    Route::post('/create-doctor', [DoctorController::class, 'createDoctor']);
    Route::get('/get-single-doctor/{id}', [DoctorController::class, 'getDoctorById']);
    Route::put('/update-doctor/{id}', [DoctorController::class, 'updateDoctor']);
    Route::delete('/delete-doctor/{id}', [DoctorController::class, 'deleteDoctor']);

    //Doctor Specializations
    Route::get('/get-doctor-specialization', [DoctorController::class, 'getDoctorSpecialization']);
    Route::post('/create-doctor-specialization', [DoctorController::class, 'createDoctorSpecialization']);



    //Patient Routes
    Route::get('/get-patient', [PatientController::class, 'getPatient']);
    Route::post('/create-patient', [PatientController::class, 'createPatient']);
    Route::get('/get-single-patient/{id}', [PatientController::class, 'getPatientById']);
    Route::put('/update-patient/{id}', [PatientController::class, 'updatePatient']);
    Route::delete('/delete-patient/{id}', [PatientController::class, 'deletePatient']);
    Route::post('book-appointment', [PatientController::class, 'BookAppointment']);
// });

// Route::post('/admin-login', [AuthController::class, 'adminLogin']);
Route::post('change-password', [AuthController::class, 'changePassword']);


