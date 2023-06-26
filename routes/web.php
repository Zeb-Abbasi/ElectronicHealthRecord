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

//  Auth ///

// Route::get('/admin/login', [AuthController::class, 'adminLoginForm'])->name('adminLoginForm');
// Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('adminLogin');

// Route::get('/patient/login', [AuthController::class, 'patientLoginForm'])->name('patientLoginForm');
// Route::post('/patient/login', [AuthController::class, 'patientLogin'])->name('patientLogin');

// Route::get('/doctor/login', [AuthController::class, 'doctorLoginForm'])->name('doctorLoginForm');
// Route::post('/doctor/login', [AuthController::class, 'doctorLogin'])->name('doctorLogin');

Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword']);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::group(['middleware' => 'auth'], function () {

    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::get('profile', [AuthController::class, 'getProfile']);
    // Route::Get('appointment-history', [DashboardController::class, 'appointmentHistory'])->name('bookAppointment');
    // Route::Get('medical-history', [DashboardController::class, ''])->name('medicalHistory');


        // Admin Role Routes
        // Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {

                //Doctors Routes
                Route::prefix('doctors')->name('doctors')->group(function () {
                    Route::get('/', [DoctorController::class, 'index'])->name('.index');
                    Route::get('/create', [DoctorController::class, 'create'])->name('.create')->middleware('check.guard:doctor');
                    Route::post('/store', [DoctorController::class, 'store'])->name('.store');
                    Route::get('/show/{id}', [DoctorController::class, 'show'])->name('.show');
                    Route::get('/edit/{id}', [DoctorController::class, 'edit'])->name('.edit');
                    Route::put('/update/{id}', [DoctorController::class, 'update'])->name('.update');
                    Route::delete('/delete/{id}', [DoctorController::class, 'destroy'])->name('.delete');
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
                    Route::get('/create-appointment', [PatientController::class, 'bookAppointment'])->name('.book-appointment')->middleware(['check.guard:patient,admin']);
                    Route::get('/store-appointment', [PatientController::class, 'storeAppointment'])->name('.store-appointment')->middleware('check.guard:patient');
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

                 // });

        // Doctor Role Routes
        // Route::middleware([RoleMiddleware::class . ':doctor'])->group(function () {

        //     //Doctors Routes
        //     // Route::get('doctors/', [DoctorController::class, 'index'])->name('doctors.index');
        //     Route::get('doctors/show/{id}', [DoctorController::class, 'show'])->name('doctors.show');
        //     Route::get('doctors/edit/{id}', [DoctorController::class, 'edit'])->name('doctors.edit');
        //     Route::put('doctors/update/{id}', [DoctorController::class, 'update'])->name('doctors.update');

        //      //Patients Routes
        //      Route::get('patients/', [DoctorController::class, 'index'])->name('patients.index');
        //      Route::get('patients/show/{id}', [DoctorController::class, 'show'])->name('patients.show');
        // });

        // Patient Role Routes
        // Route::middleware([RoleMiddleware::class . ':patient'])->group(function () {

        //     //Doctors Routes
        //     Route::get('doctors/', [DoctorController::class, 'index'])->name('doctors.index');
        //     Route::get('doctors/show/{id}', [DoctorController::class, 'show'])->name('doctors.show');

        //      //Patients Routes
        //      Route::get('patients/', [DoctorController::class, 'index'])->name('patients.index');
        //      Route::get('patients/show/{id}', [DoctorController::class, 'show'])->name('patients.show');
        //      Route::get('/create-appointment', [PatientController::class, 'bookAppointment'])->name('.book-appointment');
        //      Route::get('/store-appointment', [PatientController::class, 'storeAppointment'])->name('.store-appointment');
        // });

// });



// Route::prefix('doctors')->name('doctors')->group(function () {
        //     Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        //         Route::get('/', [DoctorController::class, 'index'])->name('.index');
        //         Route::get('/create', [DoctorController::class, 'create'])->name('.create');
        //         Route::post('/store', [DoctorController::class, 'store'])->name('.store');
        //         Route::get('/show/{id}', [DoctorController::class, 'show'])->name('.show');
        //         Route::get('/edit/{id}', [DoctorController::class, 'edit'])->name('.edit');
        //         Route::put('/update/{id}', [DoctorController::class, 'update'])->name('.update');
        //         Route::delete('/delete/{id}', [DoctorController::class, 'destroy'])->name('.delete');
        //     });
        //     // Route::middleware([RoleMiddleware::class . ':doctor'])->group(function () {
        //     //     Route::get('/', [DoctorController::class, 'index']);
        //     //     Route::get('/show/{id}', [DoctorController::class, 'show']);
        //     //     Route::put('/update/{id}', [DoctorController::class, 'update']);
        //     // });
        // });


        // Doctor Specializations Routes
        // Route::prefix('specializations')->name('specializations')->group(function () {
        //     Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        //         Route::get('/', [DoctorSpecializationController::class, 'index'])->name('.index');
        //         Route::get('/create', [DoctorSpecializationController::class, 'create'])->name('.create');
        //         Route::post('/store', [DoctorSpecializationController::class, 'store'])->name('.store');
        //         // Route::get('/show/{id}', [DoctorSpecializationController::class, 'show'])->name('show');
        //         Route::get('/edit/{id}', [DoctorSpecializationController::class, 'edit'])->name('.edit');
        //         Route::put('/update/{id}', [DoctorSpecializationController::class, 'update'])->name('.update');
        //         Route::delete('/delete/{id}', [DoctorSpecializationController::class, 'destroy'])->name('.delete');
        //     });
        //     Route::middleware([RoleMiddleware::class . ':patient'])->group(function () {
        //         Route::get('/', [DoctorSpecializationController::class, 'index'])->name('.index');
        //     });
        // });

        // Patient Routes
        // Route::prefix('patients')->name('patients')->group(function () {
        //     Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        //         Route::get('/', [PatientController::class, 'index'])->name('.index');
        //         Route::get('/create', [PatientController::class, 'create'])->name('.create');
        //         Route::post('/store', [PatientController::class, 'store'])->name('.store');
        //         Route::get('/show/{id}', [PatientController::class, 'show'])->name('.show');
        //         Route::get('/edit/{id}', [PatientController::class, 'edit'])->name('.edit');
        //         Route::put('/update/{id}', [PatientController::class, 'update'])->name('.update');
        //         Route::delete('/delete/{id}', [PatientController::class, 'destroy'])->name('.delete');
        //     });
        //     // Route::middleware([RoleMiddleware::class . ':doctor'])->group(function () {
        //     //     Route::get('/', [PatientController::class, 'index'])->name('.index');
        //     //     Route::get('/show/{id}', [PatientController::class, 'show'])->name('.show');
        //     // });
        //     // Route::middleware([RoleMiddleware::class . ':patient'])->group(function () {
        //     //     Route::get('/', [PatientController::class, 'index'])->name('.index');
        //     //     Route::get('/show/{id}', [PatientController::class, 'show'])->name('.show');
        //     // });
        // });



// Doctors Routes
// Route::prefix('doctors')->name('doctors')->group(function () {
//     Route::get('/', [DoctorController::class, 'index'])->name('.index');
//     Route::get('/create', [DoctorController::class, 'create'])->name('.create');
//     Route::post('/store', [DoctorController::class, 'store'])->name('.store');
//     Route::get('/show/{id}', [DoctorController::class, 'show'])->name('.show');
//     Route::get('/edit/{id}', [DoctorController::class, 'edit'])->name('.edit');
//     Route::put('/update/{id}', [DoctorController::class, 'update'])->name('.update');
//     Route::delete('/delete/{id}', [DoctorController::class, 'destroy'])->name('.delete');
// });

// Doctor Specialization Routes
// Route::prefix('specializations')->name('specializations')->group(function () {
//     Route::get('/', [DoctorSpecializationController::class, 'index'])->name('.index');
//     Route::get('/create', [DoctorSpecializationController::class, 'create'])->name('.create');
//     Route::post('/store', [DoctorSpecializationController::class, 'store'])->name('.store');
//     // Route::get('/show/{id}', [DoctorSpecializationController::class, 'show'])->name('show');
//     Route::get('/edit/{id}', [DoctorSpecializationController::class, 'edit'])->name('.edit');
//     Route::put('/update/{id}', [DoctorSpecializationController::class, 'update'])->name('.update');
//     Route::delete('/delete/{id}', [DoctorSpecializationController::class, 'destroy'])->name('.delete');
// });

// Patient Routes
// Route::prefix('patients')->name('patients')->group(function () {
//     Route::get('/', [PatientController::class, 'index'])->name('.index');
//     Route::get('/create', [PatientController::class, 'create'])->name('.create');
//     Route::post('/store', [PatientController::class, 'store'])->name('.store');
//     Route::get('/show/{id}', [PatientController::class, 'show'])->name('.show');
//     Route::get('/edit/{id}', [PatientController::class, 'edit'])->name('.edit');
//     Route::put('/update/{id}', [PatientController::class, 'update'])->name('.update');
//     Route::delete('/delete/{id}', [PatientController::class, 'destroy'])->name('.delete');
//     Route::get('/create-appointment', [PatientController::class, 'bookAppointment'])->name('.book-appointment');
//     Route::post('/store-appointment', [PatientController::class, 'storeAppointment'])->name('.store-appointment');
//     Route::get('/appointment-history', [PatientController::class, 'appointmentHistory'])->name('.appointment-history');


// });
