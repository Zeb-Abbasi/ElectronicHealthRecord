@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="page-heading p-4 bg-light">
            <h2 class="text-success ">BOOK APPOINTMENT</h2>
    </div>
    <div class="container-fluid mt-3 mb-5">
        <form class="addDoctorForm" method="{{ isset($doctor) ? 'PUT' : 'POST' }}">
            @csrf

            <div class="invalid-error alert alert-danger d-none"></div>

            <div class="form-group mt-3">
                <label for="doctor_specialization">Doctor Specialization</label>
                <select class="form-select mt-1" id="doctor_specialization" name="doctor_specialization" required>
                    <option value="">Select Specialization</option>
                    @foreach ($specializations as $doctor_spec)
                        <option value="{{ $doctor_spec->specialization }}">
                            {{ $doctor_spec->specialization }}
                        </option>
                    @endforeach
                </select>
                <span id="specialization_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="doctor">Doctor</label>
                <select class="form-select mt-1" id="doctor" name="doctor_id" required>
                    <option value="">Select Doctor</option>
                </select>
                <span id="doctor_id_error" class="error-message"></span>
            </div>

            <div class="form-group mt-3">
                <label for="consultancy_fees">Consultancy Fees</label>
                <input type="text" class="form-control mt-1" id="consultancy_fees" name="consultancy_fees" required
                    readonly>
                <span id="fees_error" class="error-message"></span>
            </div>
            <div class="form-group mb-3">
                <label for="dateInput" class="form-label">Select a date:</label>
                <input type="date" class="form-control" id="date" name="appointment_date">
                <span id="date_error" class="error-message"></span>
            </div>
            <div class="form-group mb-3">
                <label for="timeInput" class="form-label">Select a Time:</label>
                <input type="time" class="form-control" id="time" name="appointment_time">
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
        $(document).ready(function() {
            var specializationSelect = $("#doctor_specialization");
            var doctorSelect = $("#doctor");
            var feesInput = $("#consultancy_fees");

            specializationSelect.on("change", function() {
            var selectedSpecialization = specializationSelect.val();
            doctorSelect.html('<option value="">Select Doctor</option>');

            var filteredDoctors = {!! json_encode($doctors) !!}.filter(function(doctor) {
                return doctor.specialization === selectedSpecialization;
            });

            filteredDoctors.forEach(function(doctor) {
    var option = $("<option></option>").attr("value", doctor.id).text(doctor.user.name); // Access the name property from the user object
    doctorSelect.append(option);
});

            feesInput.val("");
        });

        doctorSelect.on("change", function() {
            var selectedDoctorId = doctorSelect.val();

            var selectedDoctor = {!! json_encode($doctors) !!}.find(function(doctor) {
                return doctor.id === parseInt(selectedDoctorId);
            });

            feesInput.val(selectedDoctor ? selectedDoctor.fees : "");
        });
    });

    </script>
    <script>
        $('#addApointment').click(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = $('.addDoctorForm').serialize();
            console.log(formData);
            $.ajax({
                url: "{{ route('patients.store-appointment') }}",
                type: 'POST',
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
                            window.location.href = "{{ route('patients.appointments') }}";
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
