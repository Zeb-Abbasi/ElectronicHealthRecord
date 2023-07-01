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
                                <td>{{ $patient->user->name }}</td>
                                <th class="text-secondary">Patient Email</th>
                                <td>{{ $patient->user->email }}</td>
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
                {{-- <th>{{ $patient->email }}</td> --}}
                    {{-- @php
                    $medical_histories = App\Models\MedicalHistory::where('patient_id', $patient->id)->where('doctor_id', Auth::user()->id )->get();
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
            @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
            @elseif(Auth::user()->role_id == 2)   
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#medicalModal">Add Medical History</button>
            @endif
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="medicalModal" tabindex="-1" aria-labelledby="medicalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="page-heading p-4 bg-light">
                    <h2 class="text-success ">ADD MEDICAL HISTORY</h2>
                </div>
                <div class="container-fluid mt-3 mb-5">
                    <form id="createMedical" action="{{ route('doctors.create-medical-history') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf                 
                        <div class="form-group mt-3">
                            <label for="diagnosis">Diagnosis</label>
                            <input type="text" class="form-control mt-1" id="diagnosis" name="diagnosis"
                                 required>
                            <span id="diagnosis_error" class="error-message"></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="blood_pressure">Blood Pressure</label>
                            <input type="text" class="form-control mt-1" id="blood_pressure" name="blood_pressure"
                                 required>
                            <span id="blood_pressure_error" class="error-message"></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="blood_sugar">Blood Sugar</label>
                            <input type="text" class="form-control mt-1" id="blood_sugar" name="blood_sugar"
                                 required>
                            <span id="blood_sugar_error" class="error-message"></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="weight">Weight</label>
                            <input type="text" class="form-control mt-1" id="weight" name="weight"
                                 required>
                            <span id="weight_error" class="error-message"></span>
                        </div>  
                        <div class="form-group mt-3">
                            <label for="temperature">Temperature</label>
                            <input type="text" class="form-control mt-1" id="temperature" name="temperature"
                                 required>
                            <span id="temperature_error" class="error-message"></span>
                        </div> 
                        <div class="form-group mt-3">
                            <label for="treatment">Treatment</label>
                            <input type="text" class="form-control mt-1" id="treatment" name="treatment"
                                 required>
                            <span id="treatment_error" class="error-message"></span>
                        </div> 
                        <div class="form-group mt-3">
                            <label for="admission_date" class="form-label">Admission Date</label>
                            <input type="date" class="form-control" id="admission_date" name="admission_date">
                            <span id="admission_date_error" class="error-message"></span>
                        </div>
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="form-group mt-3">
                            <label for="discharge_date" class="form-label">Discharge Date</label>
                            <input type="date" class="form-control" id="discharge_date" name="discharge_date">
                            <span id="discharge_date_error" class="error-message"></span>
                        </div>
                        <div class="mt-5 d-flex justify-content-end">
                            <button class="me-2 btn btn-primary  btn-success" type="submit">
                                Submit
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="submit" class="btn btn-danger"  id="confirmDeleteButton">Delete</button>
            </div> --}}
        </div>
    </div>
</div>



@endsection
@section('scripts')
    <script>
        //////////////////////////////////////////////new code


        $(document).ready(function() {
            $('#createMedical').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);
      

                $.ajax({
                    url: "{{ route('doctors.create-medical-history') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.error) {
                            validationError(response.validation_errors);
                            if (response.message) {
                                printErrorMsg(response.message);
                            }
                        } else {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            toastr.success(response.message, '', {
                                onHidden: function() {

                                    window.location.href =
                                        "{{ route('patients.show', $patient->id) }}";

                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        // Handle the error
                        console.log(xhr.responseText);
                    }
                });

                function validationError(errors) {
                    $.each(errors, function(field, messages) {
                        $.each(messages, function(index, message) {
                            $('#' + field + '_error').text(errors[field][0]);
                        });
                    });
                }

                function printErrorMsg(errors) {
                    $('.invalid-error').text(errors).removeClass('d-none');
                }
            });
        });
    </script>
@endsection
