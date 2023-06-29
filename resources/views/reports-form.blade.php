@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="page-heading p-4 bg-light">
        <h2 class="text-success ">BETWEEN DATES | REPORTS</h2>
    </div>
    <div class="container-fluid mt-3 mb-5">
        <form id="dataForm" action="{{ route('reports') }}"
            method="GET">
            @csrf
            <div class="form-group mb-3">
                <label for="fromDate" class="form-label">From Date:</label>
                <input type="date" class="form-control" id="fromDate" name="fromDate">
                <span id="fromDate_error" class="error-message"></span>
            </div>
            <div class="form-group mb-3">
                <label for="toDate" class="form-label">To Date:</label>
                <input type="date" class="form-control" id="toDate" name="toDate">
                <span id="toDate_error" class="error-message"></span>
            </div>
            



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
                            toastr.success("dsfsdafadsfads");
                            setTimeout(function() {
                                window.location.href = "{{ route('dashboard') }}";
                            }, 3000);
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
