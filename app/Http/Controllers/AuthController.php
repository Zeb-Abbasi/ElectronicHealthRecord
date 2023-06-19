<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function adminLogin(Request $request)
    // {
    //     $credentials = [
    //         'email' => $request->input('email'),
    //         'password' => $request->input('password'),
    //     ];
    //     // Perform authentication, e.g., using Laravel's Auth facade
    //     if (Auth::attempt($credentials)) {
    //         // Authentication successful
    //         $user = Auth::user();
    //         dd($user);

    //         // Store user information in the users table
    //         // $userRecord = new User([
    //         //     'username' => $user->username,
    //         //     'password' => $user->password,
    //         //     'email' => $user->email,
    //         //     'first_name' => $user->first_name,
    //         //     'last_name' => $user->last_name,
    //         //     'role' => $user->role,
    //         // ]);
    //         // $userRecord->save();

    //         // Continue with the rest of your application logic
    //     } else {
    //         // Authentication failed
    //     }
    // }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);

        }

        // Retrieve the user based on the provided email
        $user = User::where('email', $credentials['email'])->first();
        // Verify if the user exists and the password matches
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Password is correct, log in the user
            Auth::login($user);
            // Redirect to the desired location
            return redirect()->route('dashboard')->with('success', 'Login successful.');
            // Session::flash('success', 'Login successful.');
            // return redirect()->route('dashboard');
        }

        // Invalid credentials, redirect back to the login form with an error message
        return redirect()->route('adminLoginForm')->with('error', 'Invalid email or password. Please try again.');
    }

    public function showPatientLogin(){
        return view('auth.patient-login');
    }
    public function showDoctorLogin(){
        return view('auth.doctor-login');
    }
    public function adminLoginForm(){
        return view('auth.admin-login');
    }
    public function showPatientRegister(){
        return view('auth.register');
    }
    public function showForgotPassword(){
        return view('auth.forgot-password');
    }
    public function showResetPassword(){
        return view('auth.reset-password');
    }

}
