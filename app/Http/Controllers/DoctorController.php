<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function getDoctor(Request $request) {
        $doctors = Doctor::
        when($request->q, function ($query, $q) {
            return $query->where('name', 'LIKE', "%{$q}%")->orWhere('email', 'LIKE', "%{$q}%")->orWhere('contact_no', 'LIKE', "%{$q}%");
        })
        ->when($request->sortBy, function ($query, $sortBy) {
            return $query->orderBy($sortBy, request('sortDesc') == 'true' ? 'asc' : 'desc');
        })
        ->when($request->page, function ($query, $page) {
            return $query->offset($page - 1);
        })
        ->paginate($request->perPage);
        return response()->json([
            'status' => true,
            'message' => 'Doctors has been fetched successfully!',
            'data' =>  $doctors
        ]);

    }

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
        $doctor->role_id = 2;
        $doctor->save();
        return response()->json([
            'status' => true,
            'message' => 'Doctor has been created successfully!',
            'data' =>  $doctor
        ]);
    }

    public function getDoctorById($id) {
        $doctor = Doctor::getRecordById($id);
        return response()->json([
            'status' => true,
            'message' => 'Doctor has been fetched successfully!',
            'data' =>  $doctor
        ]);

    }

    public function updateDoctor(Request $request, $id) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:doctors',
            'fees' => 'required|integer',
            'specialization' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
        $doctor = Doctor::getRecordById($id);
        $data['role_id'] = 2;

        $doctor->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Doctor has been updated successfully!',
            'data' =>  $doctor
        ]);
    }

    public function deleteDoctor($id)
    {
        $doctor = Doctor::getRecordById($id);
        if (empty($doctor)) {
            return response()->json([
                'status' => false,
                'message' => 'Doctor Not Found',
                'data' =>  []
            ]);
        }
        $doctor->delete();
        return response()->json([
            'status' => true,
            'message' => 'Doctor has been Deleted Successfully!',
        ]);
    }

    public function createDoctorSpecialization(Request $request) {
        $validator = Validator::make($request->all(), [
            'specialization' => 'required|string',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
            //  Session::flash('error', $validator->messages()->first());
            //  return redirect()->back()->withInput();
        }
        $doctorSpecialization = new DoctorSpecialization($request->all());
        $doctorSpecialization->save();
        return response()->json([
            'status' => true,
            'message' => 'Doctor Specialization has been created successfully!',
            'data' =>  $doctorSpecialization
        ]);
    }
    public function getDoctorSpecialization(Request $request) {
        $doctorSpecialization = DoctorSpecialization::all();
        return response()->json([
            'status' => true,
            'message' => 'Doctor Specialization has been fetched successfully!',
            'data' =>  $doctorSpecialization
        ]);
    }
}
