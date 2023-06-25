<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            return view('admin.patients.index', compact('patients'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors =  Doctor::all();
        return view('admin.patients.patient', compact('doctors'));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::getRecordById($id);
        if ($patient) {
            return view('admin.patients.show', compact('patient'));
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
        $patient = Patient::getRecordById($id);
        $doctors = Doctor::all();
        return view('admin.patients.patient', compact('patient', 'doctors'));
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

    public function bookAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_specialization' => 'required|string',
            'doctor_id' => 'required|integer',
            'patient_id' => 'required|integer',
            'consultancy_fees' => 'required|integer',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
        ]);
        if ($validator->fails()) {
            // $errors = $validator->errors()->all();
            // return response()->json(['errors' => $errors], 422);
            return redirect()->route('patients.appointments')->withErrors($validator);
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
