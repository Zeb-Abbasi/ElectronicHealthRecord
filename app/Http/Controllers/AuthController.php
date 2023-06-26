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
        $user = Auth::user();
        if (Auth::check() && $user->role->name === 'admin') {
            return redirect()->route('dashboard')->with('user',$user);
        } else {
            return view('auth.admin-login');
        }
    }

    public function doctorLoginForm()
    {
        $user = Auth::user();
        if (Auth::check() && $user->role->name === 'doctor') {
            return redirect()->route('dashboard')->with('user',$user);
        } else {
            return view('auth.doctor-login');
        }
    }

    public function patientLoginForm()
    {
        $user = Auth::user();
        if (Auth::check() && $user->role->name === 'patient') {
            return redirect()->route('dashboard')->with('user',$user);
        } else {
            return view('auth.patient-login');
        }
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

    public function getProfile(Request $request)
    {

        $user = Auth::user();

        if ($user->role->name == 'doctor') {
                Doctor::where('id', $user->id)->get();
                return response()->json(['status' => true, 'message' => 'Profile has been fetched successfully!', 'data' => []]);
        }
        else if ($user->role->name == 'patient') {
                Patient::where('id', $user->id)->get();
                return response()->json(['status' => true, 'message' => 'Profle has been fetched successfully!', 'data' => []]);
        }
        else {
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
            //  Session::flash('error', $validator->messages()->first());
            //  return redirect()->back()->withInput();
        }

        $user = Auth::user();
        $status = Hash::check($request->old_password, $user->password);

        if ($status && $user->role->name == 'admin') {
                User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
                return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
        }
        else if ($status && $user->role->name == 'doctor') {
                Doctor::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
                return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
        }
        else if ($status && $user->role->name == 'patient') {
                Patient::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
                return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
        }
        else {
            return response()->json(['status' => false, 'message' => 'Old password not correct!', 'data' => []]);
        }

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
