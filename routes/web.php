<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('patient/register', [AuthController::class, 'showPatientRegister'])->name('patient-register');
// //////// //


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
