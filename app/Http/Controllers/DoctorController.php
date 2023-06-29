<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\MedicalHistory;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctors = Doctor::when($request->q, function ($query, $q) {
            return $query->where('name', 'LIKE', "%{$q}%")->orWhere('email', 'LIKE', "%{$q}%")->orWhere('contact_no', 'LIKE', "%{$q}%");
        })
            ->when($request->sortBy, function ($query, $sortBy) {
                return $query->orderBy($sortBy, request('sortDesc') == 'true' ? 'asc' : 'desc');
            })
            ->when($request->page, function ($query, $page) {
                return $query->offset($page - 1);
            })
            ->paginate($request->perPage);
        if ($doctors) {
            return view('admin.doctors.index', compact('doctors'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctor_specializations = DoctorSpecialization::all();

        return view('admin.doctors.doctor', compact('doctor_specializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'fees' => 'required|integer',
            'specialization' => 'required'
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
            'role_id' => 2, // Assuming role ID 2 represents doctors
        ]);

        $doctor = new Doctor($request->all());
        $doctor->user_id = $user->id;
        // $doctor->role_id  = Role::where('name', 'doctor')->value('id');
        $doctor->save();
        // toastr()->success('Data has been saved successfully!');
        return response()->json([
            'success' => true,
            'message' => 'Doctor has been created successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::getRecordById($id);
        if ($doctor) {
            return view('admin.doctors.show', compact('doctor'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role_id == 2){
            $doctor = Doctor::where('user_id',Auth::user()->id)->first();
        }
        elseif(Auth::user()->role_id == 1 || Auth::user()->role_id == 3){
            $doctor = Doctor::where('id', $id)->first();
        }   
        $doctor_specializations = DoctorSpecialization::all();
        return view('admin.doctors.doctor', compact('doctor', 'doctor_specializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = $doctor->user;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'fees' => 'required|integer',
            'specialization' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'validation_errors' => $validator->errors(),
            ]);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = 2;
        $user->save();

        $doctor->fees = $request->input('fees');
        $doctor->address = $request->input('address');
        $doctor->contact_no = $request->input('contact_no');
        $doctor->specialization = $request->input('specialization');
        $doctor->user_id = $user->id;
        // $doctor->role_id  = Role::where('name', 'doctor')->value('id');
        $doctor->save();

        return response()->json([
            'success' => true,
            'message' => 'Doctor has been updated successfully!',
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
        $doctor = Doctor::getRecordById($id);
        $user = $doctor->user;
        // Delete the doctor
        $doctor->delete();
        // Delete the associated user
        $user->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor has been deleted successfully!');
    }

    public function getDoctorAppointments(){
        // $patientId = Auth::user()->id;
        $doctor = Doctor::where('user_id',Auth::user()->id)->first();

        $appointments = Appointment::where('doctor_id', $doctor->id)->get();
        // if (checkGuard('admin') || checkGuard('doctor') || checkGuard('patient')) {
            return view('appointment_history', compact('appointments'));
        // } else {
            return redirect('/');
        // }
    }

    public function createMedicalHistory(Request $request) {
        // dd('123');
        // dd($request->discharge_date);
        $validator = Validator::make($request->all(), [
            'diagnosis' => 'required|string',
            'weight' => 'required|integer',
            'temperature' => 'required|integer',
            'admission_date' => 'required',
            'discharge_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'validation_errors' => $validator->errors(),
            ]);
        }

        $medicalHistory = new MedicalHistory($request->all());
        // $doctor->role_id = 2;
        $doctor = Doctor::where('user_id',Auth::user()->id)->first();
        $medicalHistory->doctor_id = $doctor->id;
        $medicalHistory->patient_id = $request->patient_id;
        $medicalHistory->admission_date = Carbon::createFromFormat('Y-m-d', $request->input('admission_date'));
        $medicalHistory->discharge_date = Carbon::createFromFormat('Y-m-d', $request->input('discharge_date'));
        $medicalHistory->save();
        // toastr()->success('Data has been saved successfully!');
        return response()->json([
            'success' => true,
            'message' => 'Medical History has been created successfully!',
        ]);
    }

    // public function showReportsForm(){
    //     // if (checkGuard('admin') || checkGuard('doctor') || checkGuard('patient')) {
    //     //     return view('appointments', compact('appointments'));
    //     // } else {
    //     //     return redirect('/');
    //     // }
    //     return view('reports');
    // }

    // public function getReports(){
    //     // if (checkGuard('admin') || checkGuard('doctor') || checkGuard('patient')) {
    //     //     return view('appointments', compact('appointments'));
    //     // } else {
    //     //     return redirect('/');
    //     // }
    //     return view('admin.reports');
    // }
}
