<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
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
    public function adminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function doctorLoginForm()
    {
        return view('auth.doctor-login');
    }

    public function patientLoginForm()
    {
        return view('auth.patient-login');
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

    public function doctorLogin(Request $request)
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

        if (Auth::attempt($credentials)) {
            $user = Doctor::where('email', $request->email)->first();
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Login successful.');
        }

        return response()->json([
            'error' => true,
            'message' => 'Invalid email or password. Please try again.',
        ]);
    }

    public function patientLogin(Request $request)
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

        if (Auth::attempt($credentials)) {
            $user = Patient::where('email', $request->email)->first();
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Login successful.');
        }

        return response()->json([
            'error' => true,
            'message' => 'Invalid email or password. Please try again.',
        ]);
    }

    // public function adminLogin(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);
    //     if($validator->fails()){
    //         return response()->json([
    //             'error' => true,
    //             'message' => $validator->errors()
    //         ]);

    //     }


    //      // Attempt to authenticate the admin user
    //     if (Auth::guard('admin')->attempt($credentials)) {
    //         $admin = Auth::guard('admin')->user();
    //         // Authentication successful, redirect to the admin dashboard
    //         return redirect()->route('dashboard')->with('admin',$admin);
    //         // return view('dashboard',compact('admin'));
    //     }

    // // Authentication failed, redirect back to the login form with an error message
    // return redirect()->back()->with(['error' => 'Invalid credentials']);
    // // return redirect()->route('adminLoginForm')->with('error', 'Invalid email or password. Please try again.');
    // }
}
