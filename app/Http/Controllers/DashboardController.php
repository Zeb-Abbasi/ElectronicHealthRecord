<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $admin = Auth::guard('admin')->user();
        $doctor = Auth::guard('doctor')->user();
        $patient = Auth::guard('patient')->user();
        if($admin) {
            return view('dashboard',compact('admin'));
        } else if($doctor) {
            return view('dashboard',compact('doctor'));
        } else if($patient) {
            return view('dashboard',compact('patient'));
        }
    }
}
