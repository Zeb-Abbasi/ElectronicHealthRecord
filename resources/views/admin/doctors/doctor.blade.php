@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="page-heading p-4 bg-light">
        <h2 class="text-success ">{{ isset($doctor) ? 'EDIT' : 'ADD' }} DOCTORS</h2>
    </div>
    <div class="container-fluid mt-3 mb-5">
        <form class="addDoctorForm" method="{{ isset($doctor) ? 'PUT' : 'POST' }}">
            @csrf

            <div class="invalid-error alert alert-danger d-none"></div>

            <div class="form-group mt-3">
                <label for="doctor_specialization">Doctor Specialization</label>
                <select class="form-select mt-1" id="doctor_specialization" name="specialization" required>
                    <option value="">Select Specialization</option>
                    @foreach ($doctor_specializations as $doctor_spec)
                        <option value="{{ $doctor_spec->specialization }}"
                            {{ isset($doctor) && $doctor->specialization == $doctor_spec->specialization ? 'selected' : '' }}>
                            {{ $doctor_spec->specialization }}
                        </option>
                    @endforeach
                </select>
                <span id="specialization_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="doctor_name">Doctor Name</label>
                <input type="text" class="form-control mt-1" id="doctor_name" name="name"
                    value="{{ $doctor->user->name ?? '' }}" required>
                <span id="name_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="clinic_address">Doctor Clinic Address</label>
                <input type="text" class="form-control mt-1" id="clinic_address" name="address"
                    value="{{ $doctor->address ?? '' }}" required>
                <span id="address_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="consultancy_fees">Doctor Consultancy Fees</label>
                <input type="text" class="form-control mt-1" id="consultancy_fees" name="fees"
                    value="{{ $doctor->fees ?? '' }}" required>
                <span id="fees_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="contact_no">Doctor Contact No</label>
                <input type="text" class="form-control mt-1" id="contact_no" name="contact_no"
                    value="{{ $doctor->contact_no ?? '' }}" required>
                <span id="contact_no_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="email">Doctor Email</label>
                <input type="email" class="form-control mt-1" id="email" name="email"
                    value="{{ $doctor->user->email ?? '' }}" required>
                <span id="email_error" class="error-message"></span>
            </div>
            @if (!isset($doctor))
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control mt-1" id="password" name="password" required>
                    <span id="password_error" class="error-message"></span>
                </div>

                <div class="form-group mt-3">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control mt-1" id="password_confirmation" name="confirm_password"
                        required>
                    <span id="confirm_password_error" class="error-message"></span>
                </div>
            @endif

            <button id="addDoctor" class="btn btn-primary btn-lg btn-block btn-success my-3" type="submit">
                {{ isset($doctor) ? 'Update Doctor' : 'Add Doctor' }}
            </button>
        </form>
    </div>



@endsection


@section('scripts')
    <script>
        $('#addDoctor').click(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = $('.addDoctorForm').serialize();
            var route = "{{ isset($doctor) ? route('doctors.update', $doctor->id) : route('doctors.store') }}";
            var type = "{{ isset($doctor) ? 'PUT' : 'POST' }}";
            $.ajax({
                url: route,
                type: type,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
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
                                    "{{ route('doctors.index') }}";

                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
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
    </script>
@endsection
