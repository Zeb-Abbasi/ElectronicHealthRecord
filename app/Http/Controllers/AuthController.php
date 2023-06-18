<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showPatientLogin(){
        return view('auth.patient-login');
    }
    public function showDoctorLogin(){
        return view('auth.doctor-login');
    }
    public function showAdminLogin(){
        return view('auth.admin-login');
    }
    public function showPatientRegister(){
        return view('auth.register');
    }
}
