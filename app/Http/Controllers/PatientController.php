<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function getPatient(Request $request) {
        $patients = Patient::
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
            'message' => 'Patients has been fetched successfully!',
            'data' =>  $patients
        ]);

    }

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
        $patient = new Patient($request->all());
        $patient->password = Hash::make($request->password);
        $patient->role_id = 3;
        $patient->image = $request->has('image') ? $this->uploadImage($request, 'image') : null;
        $patient->save();
        $patient['image'] = url($patient->image);
        return response()->json([
            'status' => true,
            'message' => 'Patient has been created successfully!',
            'data' =>  $patient
        ]);
    }

    public function getPatientById($id) {
        $patient = Patient::getRecordById($id);
        return response()->json([
            'status' => true,
            'message' => 'Patient has been fetched successfully!',
            'data' =>  $patient
        ]);

    }

    public function updatePatient(Request $request, $id) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:doctors',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
        $patient = Patient::getRecordById($id);
        $data['role_id'] = 3;
        if($request->has('image')) {
            $data['image'] = $this->uploadImage($request, 'image');
        }
        $patient->update($data);
        $patient['image'] = url($patient->image);
        return response()->json([
            'status' => true,
            'message' => 'Patient has been updated successfully!',
            'data' =>  $patient
        ]);
    }

    public function deletePatient($id)
    {
        $patient = Patient::getRecordById($id);
        if (empty($patient)) {
            return response()->json([
                'status' => false,
                'message' => 'Patient Not Found',
                'data' =>  []
            ]);
        }
        $patient->delete();
        return response()->json([
            'status' => true,
            'message' => 'Patient has been Deleted Successfully!',
        ]);
    }

    public function BookAppointment(Request $request) {
        $validator = Validator::make($request->all(), [
            'doctor_specialization' => 'required|string',
            'doctor_id' => 'required|integer',
            'patient_id' => 'required|integer',
            'consultancy_fees' => 'required|integer',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
            //  Session::flash('error', $validator->messages()->first());
            //  return redirect()->back()->withInput();
        }
        $appointment = new Appointment($request->all());
        $appointment->patient_id = Auth::user()->id;
        $appointment->save();

    }

    public function uploadImage(Request $request, $file_name)
    {
        $destinationPath = 'uploads/patients/';
        // if ($request->hasFile($file_name) && $request->file($file_name)->isValid()) {
            $file = $request->file($file_name);
            $name = time() . rand(1, 1000000000) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($destinationPath), $name);
            return $destinationPath . $name;

        // } else {
        //     return NULL;
        // }
    }
}
