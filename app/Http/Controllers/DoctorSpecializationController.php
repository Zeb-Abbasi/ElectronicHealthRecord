<?php

namespace App\Http\Controllers;

use App\Models\DoctorSpecialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorSpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $specializations = DoctorSpecialization::
        when($request->q, function ($query, $q) {
            return $query->where('specialization', 'LIKE', "%{$q}%");
        })
        ->when($request->sortBy, function ($query, $sortBy) {
            return $query->orderBy($sortBy, request('sortDesc') == 'true' ? 'asc' : 'desc');
        })
        ->when($request->page, function ($query, $page) {
            return $query->offset($page - 1);
        })
        ->paginate($request->perPage);

        if($specializations) {
            return view('admin.doctors.specializations.index',compact('specializations'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctors.specializations.specialization');
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
            'specialization' => 'required|string'
        ]);
        if ($validator->fails()) {
            // $errors = $validator->errors()->all();
            // return response()->json(['errors' => $errors], 422);
            return redirect()->route('specializations.index')->withErrors($validator);
            //  Session::flash('error', $validator->messages()->first());
            //  return redirect()->back()->withInput();
        } else {
            $specialization = new DoctorSpecialization($request->all());
            $specialization->specialization = $request->specialization;
            $specialization->save();
            return redirect()->route('specializations.index')->with('success', 'Specializatio has been created successfully!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $specialization = DoctorSpecialization::getRecordById($id);
    //     if($specialization) {
    //         return view('admin.doctors.show',compact('specialization'));
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialization = DoctorSpecialization::getRecordById($id);
        return view('admin.doctors.specializations.specialization',compact('specialization'));
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
            'specialization' => 'required|string',
        ]);
        if ($validator->fails()) {
            // $errors = $validator->errors()->all();
            // return response()->json(['errors' => $errors], 422);
            return redirect()->route('specializations.edit'.$id)->withErrors($validator);
            //  Session::flash('error', $validator->messages()->first());
            //  return redirect()->back()->withInput();
        } else {
            $specialization = DoctorSpecialization::getRecordById($id);
            $specialization->specialization = $request->specialization;
            $specialization->save();
            return redirect()->route('specializations.index')->with('success', 'Specialization has been created successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialization = DoctorSpecialization::getRecordById($id);
        $specialization->delete();
        return redirect()->route('specializations.index')->with('success', 'Specialization has been deleted successfully!');
    }
}
