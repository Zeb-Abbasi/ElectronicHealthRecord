<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function createPatient(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:doctors',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
            //  Session::flash('error', $validator->messages()->first());
            //  return redirect()->back()->withInput();
        }
        $doctor = new Patient($request->all());
        $doctor->password = Hash::make($request->password);
        $doctor->role_id = 2;
        $doctor->image = $this->uploadImage($request,'image');
        $doctor->save();
        return response()->json([
            'status' => true,
            'message' => 'Doctor has been created successfully!',
            'data' =>  $doctor
        ]);
    }

    public function uploadImage($request, $file_name)
    {
        $destinationPath = 'uploads/patients/';
        if ($request->hasFile($file_name)) {
            $file = $request->file($file_name);
            $name = time() . rand(1, 1000000000) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($destinationPath), $name);
            return $destinationPath . $name;
        } else {
            return NULL;
        }
    }
}
