@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
@section('content')
    <div class="page-heading p-4 bg-light">
        <h2 class="text-success">Change Password</h2>
    </div>
    <div class="container-fluid mt-3 mb-5">
        <form id="changePasswordForm" action="{{ route('change-password') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            <div class="invalid-error alert alert-danger d-none"></div>
                <div class="form-group mt-3">
                    <label for="old_password">Old Password</label>
                    <input type="password" class="form-control mt-1" id="old_password" name="old_password" required>
                    <span id="old_password_error" class="error-message"></span>
                </div>
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




            <button class="btn btn-primary btn-lg btn-block btn-success my-3" type="submit">
                Update Password
            </button>

        </form>
    </div>

@endsection


@section('scripts')
    <script>
        //////////////////////////////////////////////new code


        $(document).ready(function() {

            // Form submit event
            $('#changePasswordForm').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);


                $.ajax({
                    url: '{{route('change-password')}}',
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
                                window.location.href = "{{ route('patients.index') }}";
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


    @endsection
