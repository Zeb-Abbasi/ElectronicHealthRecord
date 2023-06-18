<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function createDoctor(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:doctors',
            'password' => 'required|string|min:8',
            'fees' => 'required|integer',
            'specialization' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
            //  Session::flash('error', $validator->messages()->first());
            //  return redirect()->back()->withInput();
        }
        $doctor = new Doctor($request->all());
        $doctor->password = Hash::make($request->password);
        $doctor->save();
        return response()->json([
            'status' => true,
            'message' => 'Doctor has been created successfully!',
            'data' =>  $doctor
        ]);
    }
}
