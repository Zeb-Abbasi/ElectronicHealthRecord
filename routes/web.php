<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorSpecializationController;
use App\Http\Controllers\PatientController;
use App\Http\Middleware\RoleMiddleware;
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

Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword']);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('change-password-view', [AuthController::class, 'viewChangePassword'])->name('change-password-view');
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('change-password');
    Route::get('profile', [AuthController::class, 'getProfile']);
    Route::get('/admin/appointments', [DashboardController::class, 'getAppointments'])->name('admin-appointments');
    Route::get('/report-form', [DashboardController::class, 'showReportForm'])->name('report-form');
    Route::get('/all-reports', [DashboardController::class, 'getReports'])->name('reports');
    Route::get('/report/{patientId}', [DashboardController::class, 'getSingleReport'])->name('report');

    //Doctors Routes
    Route::prefix('doctors')->name('doctors')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('.index');
        Route::get('/create', [DoctorController::class, 'create'])->name('.create');
        Route::post('/store', [DoctorController::class, 'store'])->name('.store');
        Route::get('/show/{id}', [DoctorController::class, 'show'])->name('.show');
        Route::get('/edit/{id}', [DoctorController::class, 'edit'])->name('.edit');
        Route::put('/update/{id}', [DoctorController::class, 'update'])->name('.update');
        Route::delete('/delete/{id}', [DoctorController::class, 'destroy'])->name('.delete');
        Route::get('/appointments', [DoctorController::class, 'getDoctorAppointments'])->name('.appointments');
        Route::post('/create-medical-history', [DoctorController::class, 'createMedicalHistory'])->name('.create-medical-history');
        // Route::get('/reports-form', [DoctorController::class, 'showDoctorReportsForm'])->name('.reports-form');
        // Route::get('/reports', [DoctorController::class, 'getDoctorReports'])->name('.reports');
    });

     //Patients Routes

    Route::prefix('patients')->name('patients')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('.index');
        Route::get('/create', [PatientController::class, 'create'])->name('.create');
        Route::post('/store', [PatientController::class, 'store'])->name('.store');
        Route::get('/show/{id}', [PatientController::class, 'show'])->name('.show');
        Route::get('/edit/{id}', [PatientController::class, 'edit'])->name('.edit');
        Route::put('/update/{id}', [PatientController::class, 'update'])->name('.update');
        Route::delete('/delete/{id}', [PatientController::class, 'destroy'])->name('.delete');
        Route::get('/create-appointment', [PatientController::class, 'bookAppointment'])->name('.book-appointment');
        Route::post('/store-appointment', [PatientController::class, 'storeAppointment'])->name('.store-appointment');
        Route::get('/appointments', [PatientController::class, 'getPatientAppointments'])->name('.appointments');
        // Route::get('/reports-form', [PatientController::class, 'showPatientReportsForm'])->name('.reports-form');
        // Route::get('/reports', [PatientController::class, 'getPatientReports'])->name('.reports');
    });
    //  Doctor Specialization Routes

    Route::prefix('specializations')->name('specializations')->group(function () {
        Route::get('/', [DoctorSpecializationController::class, 'index'])->name('.index');
        Route::get('/create', [DoctorSpecializationController::class, 'create'])->name('.create');
        Route::post('/store', [DoctorSpecializationController::class, 'store'])->name('.store');
        // Route::get('/show/{id}', [DoctorSpecializationController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [DoctorSpecializationController::class, 'edit'])->name('.edit');
        Route::put('/update/{id}', [DoctorSpecializationController::class, 'update'])->name('.update');
        Route::delete('/delete/{id}', [DoctorSpecializationController::class, 'destroy'])->name('.delete');
    });

    Route::get('/download-pdf/{patientId}', [DashboardController::class, 'downloadPDF'])->name('download.pdf');
});

