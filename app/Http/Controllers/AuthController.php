<?php

namespace App\Http\Controllers;

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
        if (Auth::check()) {
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

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Login successful.');
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Invalid email or password. Please try again.',
            ]);
        }

     }

    //  public function login(Request $request)
    //  {
    //      $validator = Validator::make($request->all(), [
    //          'email' => 'required|email',
    //          'password' => 'required',
    //      ]);

    //      if ($validator->fails()) {
    //          return response()->json([
    //              'error' => true,
    //              'validation_errors' => $validator->errors(),
    //          ]);
    //      }

    //      $credentials = $request->only('email', 'password');

    //      if (auth()->attempt($credentials)) {
    //              return redirect()->route('dashboard')->with('success', 'Login successful.');
    //          }
    //      } else if (Auth::guard('doctor')->attempt($credentials)) {
    //          $user = Doctor::where('email', $request->email)->first();
    //          if ($user && Hash::check($request->password, $user->password)) {
    //              Auth::guard('doctor')->login($user);
    //              return redirect()->route('dashboard')->with('success', 'Login successful.');
    //          }
    //      } else if (Auth::guard('patient')->attempt($credentials)) {
    //          $user = Patient::where('email', $request->email)->first();
    //          if ($user && Hash::check($request->password, $user->password)) {
    //              Auth::guard('patient')->login($user);
    //              return redirect()->route('dashboard')->with('success', 'Login successful.');
    //          }
    //      }

    //      return response()->json([
    //          'error' => true,
    //          'message' => 'Invalid email or password. Please try again.',
    //      ]);
    //  }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }
    public function showResetPassword()
    {
        return view('auth.reset-password');
    }
    public function viewChangePassword(){
        return view('update-password');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'validation_errors' => $validator->errors(),
            ]);
        }

        $user = Auth::user();
        $status = Hash::check($request->old_password, $user->password);
        if($status){
            User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
            return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Old password not correct!',
            ]);
        }


    }

    // public function changePassword(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'old_password' => 'required',
    //         'password' => 'required|string|min:6',
    //         'confirm_password' => 'required|string|min:6|same:password'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => true,
    //             'validation_errors' => $validator->errors(),
    //         ]);
    //     }

    //     if (checkGuard('admin')) {
    //         $user = Auth::guard('admin')->user();
    //         $status = Hash::check($request->old_password, $user->password);
    //         if($status){
    //             User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
    //             return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
    //         } else {
    //             return response()->json([
    //                 'error' => true,
    //                 'message' => 'Old password not correct!',
    //             ]);
    //         }

    //     } else if (checkGuard('doctor')) {
    //         $user = Auth::guard('doctor')->user();
    //         $status = Hash::check($request->old_password, $user->password);
    //         if($status){
    //             Doctor::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
    //             return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
    //         } else {
    //             return response()->json([
    //                 'error' => true,
    //                 'message' => 'Old password not correct!',
    //             ]);
    //         }
    //     } else if (checkGuard('patient')) {
    //         $user = Auth::guard('patient')->user();
    //         $status = Hash::check($request->old_password, $user->password);
    //         if($status){
    //             Patient::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
    //             return response()->json(['status' => true, 'message' => 'Password has been updated successfully!', 'data' => []]);
    //         } else {
    //             return response()->json([
    //                 'error' => true,
    //                 'message' => 'Old password not correct!',
    //             ]);

    //         }
    //     }
    // }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
