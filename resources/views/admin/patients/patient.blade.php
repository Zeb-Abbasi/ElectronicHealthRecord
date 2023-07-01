@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="page-heading p-4 bg-light">
        <h2 class="text-success ">{{ isset($patient) ? 'EDIT' : 'ADD' }} PATIENTS</h2>
    </div>
    <div class="container-fluid mt-3 mb-5">
        <form id="dataForm" action="{{ isset($patient) ? route('patients.update', $patient->id) : route('patients.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($patient))
                @method('PUT')
            @endif

            <div class="form-group mt-3">
                <label for="doctor">Doctor</label>
                <select class="form-select mt-1" id="doctor" name="doctor_id" required>
                    <option value="">Select Doctor</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}"
                            {{ isset($doctor) && $doctor->user->name == $doctor->user->name ? 'selected' : '' }}>
                            {{ $doctor->user->name }}
                        </option>
                    @endforeach
                </select>
                <span id="doctor_id_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="patient">Name</label>
                <input type="text" class="form-control mt-1" id="name" name="name"
                    value="{{ $patient->user->name ?? '' }}" required>
                <span id="name_error" class="error-message"></span>
            </div>
            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control mt-1" id="email" name="email"
                    value="{{ $patient->user->email ?? '' }}" required>
                <span id="email_error" class="error-message"></span>
            </div>
            <div class="form-group mt-3">
                <label for="contact_no">Contact No</label>
                <input type="text" class="form-control mt-1" id="contact_no" name="contact_no"
                    value="{{ $patient->contact_no ?? '' }}" required>
                <span id="contact_no_error" class="error-message"></span>
            </div>
            <div class="form-group mt-3">
                <label for="address">Address</label>
                <input type="text" class="form-control mt-1" id="address" name="address"
                    value="{{ $patient->address ?? '' }}" required>
                <span id="address_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="gender">Gender</label>
                <input type="text" class="form-control mt-1" id="gender" name="gender"
                    value="{{ $patient->gender ?? '' }}" required>
                <span id="gender_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="age">Age</label>
                <input type="number" class="form-control mt-1" id="age" name="age"
                    value="{{ $patient->age ?? '' }}" required>
                <span id="age_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="age">Medical History</label>
                <input type="text" class="form-control mt-1" id="med_his" name="med_his"
                    value="{{ $patient->age ?? '' }}" required>
                <span id="med_his_error" class="error-message"></span>
            </div>

            <div class="my-3">
                <label for="image" class="form-label">Select an image:</label>
                <input type="file" class="form-control" id="image" name="image">
                @if (isset($patient) && $patient->image)
                    <img class="mt-3" id="uploadedImage" src="{{ asset($patient->image) }}" alt="Uploaded Image"
                        width="230" height="200">
                @else
                    <img class="d-none mt-3" id="uploadedImage" src="default-placeholder.jpg"
                        alt="Default Placeholder Image" width="230" height="200">
                @endif
            </div>

            @if (!isset($patient))
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control mt-1" id="password" name="password" required>
                    <span id="password_error" class="error-message"></span>
                </div>

                <div class="form-group mt-3">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control mt-1" id="confirm_password" name="confirm_password"
                        required>
                    <span id="confirm_password_error" class="error-message"></span>
                </div>
            @endif



            <button class="btn btn-primary btn-lg btn-block btn-success my-3" type="submit">
                {{ isset($patient) ? 'Update Patient' : 'Add Patient' }}
            </button>

        </form>
    </div>

@endsection


@section('scripts')
    <script>
        //////////////////////////////////////////////new code

        $(document).ready(function() {
            $('#image').change(function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#uploadedImage').attr('src', e.target.result);
                    $('#uploadedImage').removeClass('d-none');
                };

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    $('#uploadedImage').addClass('d-none');
                }
            });

            // Form submit event
            $('#dataForm').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                var route =
                    "{{ isset($patient) ? route('patients.update', $patient->id) : route('patients.store') }}";

                $.ajax({
                    url: route,
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
                                        "{{ route('patients.index') }}";

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
