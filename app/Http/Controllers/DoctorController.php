<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
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
            'email' => 'required|email|unique:doctors',
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

        $doctor = new Doctor($request->all());
        $doctor->password = Hash::make($request->password);
        $doctor->role_id = 2;
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
        $doctor = Doctor::getRecordById($id);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'fees' => 'required|integer',
            'specialization' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'validation_errors' => $validator->errors(),
            ]);
        }
    
        $doctor = Doctor::findOrFail($id);
        $doctor->name = $request->input('name');
        $doctor->email = $request->input('email');
        $doctor->fees = $request->input('fees');
        $doctor->address = $request->input('address');
        $doctor->contact_no = $request->input('contact_no');
        $doctor->specialization = $request->input('specialization');
        $doctor->role_id = 2;
        $doctor->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Doctor has been created successfully!',
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
        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor has been deleted successfully!');
    }
}
