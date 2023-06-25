@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="page-heading p-4 bg-light">
        <h2 class="text-success ">PATIENT</h2>
    </div>
    <div class="container-fluid mt-3 mb-5">

        <h3 class="text-success fw-bold mb-5">Patient Details</h3>
        <div class="row">
            <div class="col-lg-3 d-flex flex-column">
                <div class="flex-grow-1">
                    <img src="{{ asset($patient->image) }}" alt="" class="w-100 h-100 object-fit-cover">
                </div>
            </div>
            <div class="col-lg-9">
                <div class="table-responsive mt-3 mt-lg-0">
                    <table class="table table-bordered mb-0" style="width: 100%">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center fs-5 text-secondary">Patient Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-secondary">Patient Name</th>
                                <td>{{ $patient->name }}</td>
                                <th class="text-secondary">Patient Email</th>
                                <td>{{ $patient->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Patient Mobile Number</th>
                                <td>{{ $patient->contact_no }}</td>
                                <th class="text-secondary">Patient Address</th>
                                <td>{{ $patient->address }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Patient Gender</th>
                                <td>{{ $patient->gender }}</td>
                                <th class="text-secondary">Patient Age</th>
                                <td>{{ $patient->age }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Patient Medical History (if any)</th>
                                <td>{{ $patient->med_his }}</td>
                                <th class="text-secondary">Patient Reg Date</th>
                                <td>{{ $patient->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <table class="table  table-bordered mt-4" style="width:100%">
            <thead>
                <th colspan="4" class="text-center fs-5 text-secondary">Medical History</th>
            </thead>
            <tbody>
                <tr class="text-secondary">
                    <th>Patient Name</th>
                    <th>{{ $patient->name }}</td>
                    <th>Patient Email</th>
                    <th>{{ $patient->email }}</td>
                </tr>
                {{-- <tr>
                        <th>Patient Mobile Number</th>
                        <td>{{ $patient->contact_no }}</td>
                        <th>Patient Address</th>
                        <td>{{ $patient->address }}</td>
                    <tr>
                    <tr>
                        <th>Patient Gender</th>
                        <td>{{ $patient->gender }}</td>
                        <th>Patient Age</th>
                        <td>{{ $patient->age }}</td>
                    <tr>
                    <tr>
                        <th>Patient Medical History(if any)</th>
                        <td>{{ $patient->med_his }}</td>
                        <th>Patient Reg Date</th>
                        <td>{{ $patient->created_at }}</td>
                    <tr> --}}
            </tbody>
        </table>
    </div>





@endsection
