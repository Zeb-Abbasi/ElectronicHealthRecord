<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\MedicalHistory;
use App\Models\Patient;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{


    public function index(Request $request)
    {
        // $patients = Patient::
        // when($request->q, function ($query, $q) {
        //     return $query->where('name', 'LIKE', "%{$q}%")->orWhere('email', 'LIKE', "%{$q}%")->orWhere('contact_no', 'LIKE', "%{$q}%");
        // })
        // ->when($request->sortBy, function ($query, $sortBy) {
        //     return $query->orderBy($sortBy, request('sortDesc') == 'true' ? 'asc' : 'desc');
        // })
        // ->when($request->page, function ($query, $page) {
        //     return $query->offset($page - 1);
        // })
        // ->paginate($request->perPage);
        $patients = Patient::all();
        if ($patients) {
            if (checkGuard('admin') || checkGuard('doctor') || checkGuard('patient')) {
                return view('admin.patients.index', compact('patients'));
            } else {
                return redirect('/');
            }
        }
    }


    public function create()
    {
        $doctors =  Doctor::all();
        if (checkGuard('admin') || checkGuard('doctor') || checkGuard('patient')) {
            return view('admin.patients.patient', compact('doctors'));
        } else {
            return redirect('/');
        }
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:patients',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'validation_errors' => $validator->errors(),
            ]);
        }
        $patient = new Patient($request->all());
        $patient->password = Hash::make($request->password);
        // $patient->role_id = 3;
        $patient->role_id  = Role::where('name', 'patient')->value('id');
        $patient->image = $request->has('image') ? $this->uploadImage($request, 'image') : null;
        $patient->save();
        return response()->json([
            'success' => true,
            'message' => 'Patient has been created successfully!',
        ]);
    }

    public function show($id)
    {
        $patient = Patient::getRecordById($id);
        $medicalHistory = MedicalHistory::where('patient_id',$id)->get();
        if ($patient) {
            if (checkGuard('admin') || checkGuard('doctor') || checkGuard('patient')) {
                return view('admin.patients.show', compact('patient','medicalHistory'));
            } else {
                return redirect('/');
            }
        }
    }


    public function edit($id)
    {
        $patient = Patient::getRecordById($id);
        $doctors = Doctor::all();
        if (checkGuard('admin') || checkGuard('doctor') || checkGuard('patient')) {
            return view('admin.patients.patient', compact('patient', 'doctors'));
        } else {
            return redirect('/');
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'validation_errors' => $validator->errors(),
            ]);
        }
        $patient = Patient::findOrFail($id);
        // $doctor = Doctor::findOrFail($id);
        $patient->name = $request->input('name');
        $patient->email = $request->input('email');
        $patient->gender = $request->input('gender');
        $patient->address = $request->input('address');
        $patient->contact_no = $request->input('contact_no');
        $patient->age = $request->input('age');
        $patient->med_his = $request->input('med_his');
        // $patient->role_id = 3;
        $patient->role_id  = Role::where('name', 'patient')->value('id');

        if ($request->has('image')) {
            $patient->image = $this->uploadImage($request, 'image');
        }
        $patient->save();

        return response()->json([
            'success' => true,
            'message' => 'Patient has been updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::getRecordById($id);
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient has been deleted successfully!');
    }

    public function bookAppointment(){
        $doctors =  Doctor::all();
        $specializations = DoctorSpecialization::all();
        return view('patients.appointments.book_appointment', compact('doctors', 'specializations'));
    }

    public function storeAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_specialization' => 'required|string',
            'doctor_id' => 'required|integer',
            'consultancy_fees' => 'required|integer',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'validation_errors' => $validator->errors(),
            ]);
        }
        $appointment = new Appointment($request->all());
        $appointment->patient_id = Auth::guard('patient')->user()->id;
        $appointment->save();
    }

    public function getPatientAppointments(){
        $patientId = Auth::guard('patient')->user()->id;
        $appointments = Appointment::where('patient_id',$patientId)->with('doctor', 'patient')->get();
        // if (checkGuard('admin') || checkGuard('doctor') || checkGuard('patient')) {
            return view('appointment_history', compact('appointments'));
        // } else {
            return redirect('/');
        // }
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
