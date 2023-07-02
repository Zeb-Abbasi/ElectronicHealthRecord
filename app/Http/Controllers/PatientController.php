<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\MedicalHistory;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{


    public function index(Request $request)
    {
        if(Auth::user()->role_id == 2) {
            $patients = Patient::where('doctor_id',Auth::user()->doctors[0]->id)->get();
        }
        else {
            $patients = Patient::all();
        }
        return view('admin.patients.index', compact('patients'));
    }


    public function create()
    {
        $doctors =  Doctor::all();
        return view('admin.patients.patient', compact('doctors'));
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'validation_errors' => $validator->errors(),
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3, // Assuming role ID 2 represents doctors
        ]);

        $patient = new Patient($request->all());
        $patient->user_id = $user->id;
        // $patient->role_id  = Role::where('name', 'patient')->value('id');
        $patient->image = $request->has('image') ? $this->uploadImage($request, 'image') : null;
        $patient->save();
        return response()->json([
            'success' => true,
            'message' => 'Patient has been created successfully!',
        ]);
    }

    public function show($id){
        if(Auth::user()->role_id == 3){
            $patient = Patient::where('user_id', $id)->first();
        }
        elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 1){
            $patient = Patient::where('id', $id)->first();
        }
        $medicalHistory = MedicalHistory::where('patient_id',$patient->id)->get();
        if ($patient) {
            return view('admin.patients.show', compact('patient','medicalHistory'));
        }
    }


    public function edit($id)
    {
    if(Auth::user()->role_id == 3){
        $patient = Patient::where('user_id', $id)->first();
    }
    elseif(Auth::user()->role_id == 2 || Auth::user()->role_id == 1){
        $patient = Patient::where('id', $id)->first();
    }

        $doctors = Doctor::all();
        return view('admin.patients.patient', compact('patient', 'doctors'));
    }


    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $user = $patient->user;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'validation_errors' => $validator->errors(),
            ]);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = 3;
        $user->save();


        // $doctor = Doctor::findOrFail($id);
        $patient->gender = $request->input('gender');
        $patient->address = $request->input('address');
        $patient->contact_no = $request->input('contact_no');
        $patient->age = $request->input('age');
        $patient->med_his = $request->input('med_his');
        $patient->user_id = $user->id;

        // $patient->role_id  = Role::where('name', 'patient')->value('id');

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
        dd($id);
        $patient = Patient::findOrFail($id);

        $user = $patient->user;
        // Delete the doctor
        $patient->delete();
        // Delete the associated user
        $user->delete();
        return redirect()->route('patients.index')->with('success', 'Patient has been deleted successfully!');
    }

    public function bookAppointment(){
        $doctors =  Doctor::with('user')->get();
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
        $patient =Patient::where('user_id',Auth::user()->id)->first();
        $appointment = new Appointment($request->all());
        $appointment->patient_id = $patient->id;
        $appointment->save();
    }

    public function getPatientAppointments(){
        $patient = Patient::where('user_id',Auth::user()->id)->first();

        $appointments = Appointment::where('patient_id',$patient->id)->get();
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
