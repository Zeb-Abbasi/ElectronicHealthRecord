<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
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

    //     // Retrieve the user based on the provided email
    //     $user = User::where('email', $credentials['email'])->first();
    //     // Verify if the user exists and the password matches
    //     if ($user && Hash::check($credentials['password'], $user->password)) {
    //         // Password is correct, log in the user
    //         Auth::login($user);
    //         // Redirect to the desired location
    //         return redirect()->route('dashboard')->with('success', 'Login successful.');
    //         // Session::flash('success', 'Login successful.');
    //         // return redirect()->route('dashboard');
    //     }

    //     // Invalid credentials, redirect back to the login form with an error message
    //     return redirect()->route('adminLoginForm')->with('error', 'Invalid email or password. Please try again.');
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


         // Attempt to authenticate the admin user
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            // Authentication successful, redirect to the admin dashboard
            return redirect()->route('dashboard')->with('admin',$admin);
            // return view('dashboard',compact('admin'));
        }

    // Authentication failed, redirect back to the login form with an error message
    return redirect()->back()->with(['error' => 'Invalid credentials']);
    // return redirect()->route('adminLoginForm')->with('error', 'Invalid email or password. Please try again.');
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
        dd($user);

        $status = Hash::check($request->old_password, $user->password);

        if ($status && $user->role_id == 1) {
                User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
                return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
        }
        else if ($status && $user->role_id == 2) {
                Doctor::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
                return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
        }
        else if ($status && $user->role_id == 1) {
                Patient::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
                return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
        }
        else {
            return response()->json(['status' => false, 'message' => 'Old password not correct!', 'data' => []]);
        }

    }
//     public function changePassword(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'current_password' => 'required',
//         'new_password' => 'required|string|min:8',
//         'confirm_password' => 'required|string|min:8|same:new_password',
//     ]);

//     if ($validator->fails()) {
//         $errors = $validator->errors()->all();
//         return response()->json(['errors' => $errors], 422);
//         //  Session::flash('error', $validator->messages()->first());
//         //  return redirect()->back()->withInput();
//     }

//     $user = Auth::user();
//     $currentPassword = $request->current_password;
//     $newPassword = $request->new_password;

//     // Check if the current password matches the user's stored password
//     if (!Hash::check($currentPassword, $user->password)) {
//         return response()->json(['error' => 'The current password is incorrect.'], 422);
//     }

//     // Update the user's password
//     $user->update([
//         'password' => Hash::make($newPassword),
//     ]);

//     return response()->json([
//         'status' => true,
//         'message' => 'Password changed successfully!',
//     ]);
// }


}
