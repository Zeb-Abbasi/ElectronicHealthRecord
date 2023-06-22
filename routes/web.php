<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorSpecializationController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('homepage');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');



//  Auth ///
Route::get('/admin/login', [AuthController::class, 'adminLoginForm'])->name('adminLoginForm');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('adminLogin');

Route::get('/patient/login', [AuthController::class, 'patientLoginForm'])->name('patientLoginForm');
Route::post('/patient/login', [AuthController::class, 'patientLogin'])->name('patientLogin');

Route::get('/doctor/login', [AuthController::class, 'doctorLoginForm'])->name('doctorLoginForm');
Route::post('/doctor/login', [AuthController::class, 'doctorLogin'])->name('doctorLogin');


Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword']);
// Route::post('change-password', [AuthController::class, 'changePassword']);


Route::get('patient/register', [AuthController::class, 'showPatientRegister'])->name('patient-register');
// //////// //


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Doctors Routes
Route::prefix('doctors')->name('doctors')->group(function () {
    Route::get('/', [DoctorController::class, 'index'])->name('.index');
    Route::get('/create', [DoctorController::class, 'create'])->name('.create');
    Route::post('/store', [DoctorController::class, 'store'])->name('.store');
    Route::get('/show/{id}', [DoctorController::class, 'show'])->name('.show');
    Route::get('/edit/{id}', [DoctorController::class, 'edit'])->name('.edit');
    Route::put('/update/{id}', [DoctorController::class, 'update'])->name('.update');
    Route::delete('/delete/{id}', [DoctorController::class, 'destroy'])->name('.delete');
});

// Doctor Specialization Routes
Route::prefix('specializations')->name('specializations')->group(function () {
    Route::get('/', [DoctorSpecializationController::class, 'index'])->name('index');
    Route::get('/create', [DoctorSpecializationController::class, 'create'])->name('create');
    Route::post('/store', [DoctorSpecializationController::class, 'store'])->name('store');
    // Route::get('/show/{id}', [DoctorSpecializationController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [DoctorSpecializationController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [DoctorSpecializationController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [DoctorSpecializationController::class, 'destroy'])->name('delete');
});

// Patient Routes
Route::prefix('patients')->group(function () {
    Route::get('/', [PatientController::class, 'index'])->name('index');
    Route::get('/create', [PatientController::class, 'create'])->name('create');
    Route::post('/store', [PatientController::class, 'store'])->name('store');
    Route::get('/show/{id}', [PatientController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [PatientController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [PatientController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [PatientController::class, 'destroy'])->name('delete');
});
