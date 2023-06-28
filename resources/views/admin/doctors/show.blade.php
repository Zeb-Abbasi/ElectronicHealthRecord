@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="page-heading p-4 bg-light">
        <h2 class="text-success ">DOCTOR</h2>
    </div>
    <div class="container-fluid mt-3 mb-5">

        <h3 class="text-success fw-bold mb-5">Doctor Details</h3>
        <div class="row">
            {{-- <div class="col-lg-12"> --}}
            <div class="table-responsive mt-3 mt-lg-0">
                <table class="table table-bordered mb-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center fs-5 text-secondary">Doctor Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-secondary">Doctor Name</th>
                            <td>{{ $doctor->user->name }}</td>
                            <th class="text-secondary">Doctor Email</th>
                            <td>{{ $doctor->user->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Doctor Mobile Number</th>
                            <td>{{ $doctor->contact_no }}</td>
                            <th class="text-secondary">Doctor Address</th>
                            <td>{{ $doctor->address }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Doctor Gender</th>
                            <td>{{ $doctor->gender }}</td>
                            <th class="text-secondary">Doctor Age</th>
                            <td>{{ $doctor->age }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Doctor Medical History (if any)</th>
                            <td>{{ $doctor->med_his }}</td>
                            <th class="text-secondary">Doctor Reg Date</th>
                            <td>{{ $doctor->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- </div> --}}
        </div>


    </div>





@endsection
