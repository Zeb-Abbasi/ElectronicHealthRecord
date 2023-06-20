<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    ////// get form views /////////////////////
    public function patientLoginForm()
    {
        return view('auth.patient-login');
    }
    public function doctorLoginForm()
    {
        return view('auth.doctor-login');
    }
    public function adminLoginForm()
    {
        return view('auth.admin-login');
    }
    public function showPatientRegister()
    {
        return view('auth.register');
    }
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }
    public function showResetPassword()
    {
        return view('auth.reset-password');
    }


    // post login //
    
    public function adminLogin(Request $request)
    {
        return $this->loginUser($request, 1);
    }
    
    public function doctorLogin(Request $request)
    {
        return $this->loginUser($request, 2);
    }
    
    public function patientLogin(Request $request)
    {
        return $this->loginUser($request, 3);
    }

    public function loginUser(Request $request, $roleId)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'validation_errors' => $validator->errors(),
            ]);
        }
    
        $credentials = $request->only('email', 'password');
        $credentials['role_id'] = $roleId;
    
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Login successful.');
        }
    
        return response()->json([
            'error' => true,
            'message' => 'Invalid email or password. Please try again.',
        ]);
    }
}
