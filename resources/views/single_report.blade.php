@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="page-heading p-4 bg-light">
        <h2 class="text-success ">PATIENT</h2>
    </div>
    <div class="container-fluid mt-3 mb-5">

        <h3 class="text-success fw-bold mb-5">Patient Reports</h3>
        <div class="row">
            <div class="col-lg-3 d-flex flex-column">
                <div class="flex-grow-1">
                    <img src="{{ asset($report->image) }}" alt="" class="w-100 h-100 object-fit-cover">
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
                                <td>{{ $report->user->name }}</td>
                                <th class="text-secondary">Patient Email</th>
                                <td>{{ $report->user->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Patient Mobile Number</th>
                                <td>{{ $report->contact_no }}</td>
                                <th class="text-secondary">Patient Address</th>
                                <td>{{ $report->address }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Patient Gender</th>
                                <td>{{ $report->gender }}</td>
                                <th class="text-secondary">Patient Age</th>
                                <td>{{ $report->age }}</td>
                            </tr>
                            <tr>
                                <th class="text-secondary">Patient Medical History (if any)</th>
                                <td>{{ $report->med_his }}</td>
                                <th class="text-secondary">Patient Reg Date</th>
                                <td>{{ $report->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <table class="table  table-bordered mt-4" style="width:100%">
            <thead>
                <th colspan="6" class="text-center fs-5 text-secondary">Medical History</th>
            </thead>
            <tbody>
                <tr class="text-secondary">
                    <th>Blood Pressure</th>
                    <th>Weight</th>
                    <th>Blood Sugar</th>
                    <th>Body Temprature</th>
                    <th>Medical Prescription</th>
                    <th>Visit Date</th>
                </tr>
                {{-- <th>{{ $report->email }}</td> --}}
                    {{-- @php
                    $medical_histories = App\Models\MedicalHistory::where('patient_id', $report->id)->where('doctor_id', Auth::user()->id )->get();
                @endphp --}}
                
                @foreach ($medicalHistory as $medical_history)
                <tr>                    
                    <td>{{ $medical_history->blood_pressure }}</td>
                    <td>{{ $medical_history->weight }}</td>
                    <td>{{ $medical_history->blood_sugar }}</td>
                    <td>{{ $medical_history->temperature }}</td>
                    <td>{{ $medical_history->treatment }}</td>
                    <td>{{ $medical_history->admission_date }}</td>
                <tr>
                @endforeach
                
                    
            </tbody>
        </table>
        <div class="text-center">
            {{-- <a href="{{ route('generate-pdf') }}" class="btn btn-success" target="_blank">Generate PDF</a> --}}
            <a href="#" class="btn btn-success" target="_blank">Generate PDF</a>

        </div>
    </div>




@endsection
@section('scripts')
    <script>

        // $(document).ready(function() {
           
        // });
    </script>
@endsection
