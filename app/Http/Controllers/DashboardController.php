<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if (checkGuard('admin') || checkGuard('doctor') || checkGuard('patient')) {
            return view('dashboard');
        } else {
            return redirect('/');
        }
    }
}
