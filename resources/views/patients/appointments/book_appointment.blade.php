@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="container-fluid mt-5">
        <form class="addDoctorForm" method="{{ isset($doctor) ? 'PUT' : 'POST' }}">
            @csrf

            <div class="invalid-error alert alert-danger d-none"></div>

            <div class="form-group mt-3">
                <label for="doctor_specialization">Doctor Specialization</label>
                <select class="form-select mt-1" id="doctor_specialization" name="specialization" required>
                    <option value="">Select Specialization</option>
                    @foreach ($specializations as $doctor_spec)
                        <option value="{{ $doctor_spec->specialization }}">
                            {{ $doctor_spec->specialization }}
                        </option>
                    @endforeach
                </select>
                <span id="specialization_error" class="error-message"></span>
            </div>
            @php
                $selectedSpecialization = $_GET['specialization'] ?? null;
            @endphp
            <div class="form-group mt-3">
                <label for="doctor">Doctor</label>
                <select class="form-select mt-1" id="doctor" name="doctor_id" required>
                    <option value="">Select Doctor</option>

                    @foreach ($doctors->where('specialization', $selectedSpecialization) as $doctor)
                        <option value="{{ $doctor->id }}">
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
                <span id="doctor_id_error" class="error-message"></span>
            </div>
            <div class="form-group mt-3">
                <label for="consultancy_fees">Consultancy Fees</label>
                <input type="text" value="{{\App\Models\Doctor::where('name', $selectedDoctor)->first()}}" class="form-control mt-1" id="consultancy_fees" name="fees" required>
                <span id="fees_error" class="error-message"></span>
            </div>
            <div class="form-group mb-3">
                <label for="dateInput" class="form-label">Select a date:</label>
                <input type="date" class="form-control" id="dateInput">
                <span id="date_error" class="error-message"></span>
            </div>
            <div class="form-group mb-3">
                <label for="timeInput" class="form-label">Select a date:</label>
                <input type="time" class="form-control" id="timeInput">
                <span id="time_error" class="error-message"></span>
            </div>

            <button id="addApointment" class="btn btn-primary btn-lg btn-block btn-success my-3" type="submit">
                Book Appointment
            </button>
        </form>
    </div>



@endsection


@section('scripts')
    <script>
        document.getElementById('doctor_specialization').addEventListener('change', function() {
            var selectedValue = this.value;
            window.location.href = window.location.pathname + '?specialization=' + selectedValue;
        });
        $('#addApointment').click(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = $('.addDoctorForm').serialize();
            $.ajax({
                url: "{{ route('patients.store-appointment') }}",
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
                        toastr.success("dsfsdafadsfads");
                        setTimeout(function() {
                            window.location.href = "{{ route('doctors.index') }}";
                        }, 3000);
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
