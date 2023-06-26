<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    ////// get form views /////////////////////
    public function loginForm()
    {
        if (Auth::guard('doctor')->check() || Auth::guard('patient')->check() || Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        } else {
            return view('auth.login');
        }
    }

     // post login //
     public function login(Request $request)
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

         if (Auth::guard('admin')->attempt($credentials)) {
             $user = User::where('email', $request->email)->first();
             if ($user && Hash::check($request->password, $user->password)) {
                 Auth::guard('admin')->login($user);
                 return redirect()->route('dashboard')->with('success', 'Login successful.');
             }
         } else if (Auth::guard('doctor')->attempt($credentials)) {
             $user = Doctor::where('email', $request->email)->first();
             if ($user && Hash::check($request->password, $user->password)) {
                 Auth::guard('doctor')->login($user);
                 return redirect()->route('dashboard')->with('success', 'Login successful.');
             }
         } else if (Auth::guard('patient')->attempt($credentials)) {
             $user = Patient::where('email', $request->email)->first();
             if ($user && Hash::check($request->password, $user->password)) {
                 Auth::guard('patient')->login($user);
                 return redirect()->route('dashboard')->with('success', 'Login successful.');
             }
         }

         return response()->json([
             'error' => true,
             'message' => 'Invalid email or password. Please try again.',
         ]);
     }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }
    public function showResetPassword()
    {
        return view('auth.reset-password');
    }


    public function getProfile(Request $request)
    {

        $user = Auth::user();

        if ($user->role->name == 'doctor') {
            Doctor::where('id', $user->id)->get();
            return response()->json(['status' => true, 'message' => 'Profile has been fetched successfully!', 'data' => []]);
        } else if ($user->role->name == 'patient') {
            Patient::where('id', $user->id)->get();
            return response()->json(['status' => true, 'message' => 'Profle has been fetched successfully!', 'data' => []]);
        } else {
            return response()->json(['status' => false, 'message' => 'Profile not correct!', 'data' => []]);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'current_password' => 'required',
            // 'new_password' => 'required|string|min:8',
            // 'confirm_password' => 'required|string|min:8|same:new_password',
            'old_password' => 'required',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:password'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }

        $user = Auth::user();
        $status = Hash::check($request->old_password, $user->password);

        if ($status && Auth::guard('admin')) {
            User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
            return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
        } else if ($status && Auth::guard('doctor')) {
            Doctor::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
            return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
        } else if ($status && Auth::guard('patient')) {
            Patient::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
            return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
        } else {
            return response()->json(['status' => false, 'message' => 'Old password not correct!', 'data' => []]);
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('doctor')->check()) {
            Auth::guard('doctor')->logout();
        } elseif (Auth::guard('patient')->check()) {
            Auth::guard('patient')->logout();
        }

        return redirect('/');
    }
}
