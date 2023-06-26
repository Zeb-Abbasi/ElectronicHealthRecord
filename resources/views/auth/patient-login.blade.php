@extends('layouts.auth')

@section('title', 'Electronic Health Record')

@section('content')

    <h3 class="mb-5 text-success">EHR | Patient Login</h3>
    <form class="patientLoginForm" method="POST">
        @csrf
        <div class="invalid-error alert alert-danger d-none"></div>
        <div class="form-outline mb-2">
            <label class="form-label text-success" for="typeEmailX-2">Email</label>
            <input type="email" id="typeEmailX-2" class="form-control form-control-lg" name="email" />
            <span id="email_error" class="error-message"></span>
        </div>

        <div class="form-outline mb-3">
            <label class="form-label text-success" for="typePasswordX-2">Password</label>
            <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" />
            <span id="password_error" class="error-message"></span>
        </div>

        <!-- Checkbox -->
        <div class="form-check d-flex justify-content-start mb-4">
            <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
            <label class="form-check-label ms-2 text-success" for="form1Example3"> Remember password
            </label>
        </div>

        <button id="patientLogin" class="btn btn-primary btn-lg btn-block btn-success" type="submit">Login</button>
    </form>



    <div class="mt-3">
        <a class="text-success" href="{{ route('forgot-password') }}">Forgot Password</a>
    </div>
    <hr class="my-4">

    <div class="text-center">
        <p class="text-secondary">Don't have an account yet? <a class="text-success" href="{{ route('patient-register') }}">
                Create an account</a></p>
    </div>
    <div class="copyright text-secondary text-center">
        &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> EHR</span>. <span>All rights
            reserved</span>
    </div>
@endsection

@section('scripts')
    <script>
        $('#patientLogin').click(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = $('.patientLoginForm').serialize();
            $.ajax({
                url: "{{ route('login') }}",
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.error) {
                        console.log(response.validation_errors);
                        if (response.validation_errors) {
                            validationError(response.validation_errors);
                        }
                        if (response.message) {
                            printErrorMsg(response.message);
                        }
                    } else {
                        window.location.href = "{{ route('dashboard') }}";
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
