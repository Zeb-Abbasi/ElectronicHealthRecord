@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
<div class="page-heading p-4 bg-light">
    <h2 class="text-success ">{{ isset($specialization) ? 'EDIT' : 'ADD' }} DOCTOR SPECIALIZATION</h2>
</div>
    <div class="container-fluid mt-3 mb-5">
        <form class="addSpecializationForm" method="{{ isset($specialization) ? 'PUT' : 'POST' }}">
            @csrf
            <div class="invalid-error alert alert-danger d-none"></div>


            <div class="form-group mt-3">
                <label for="specialization">Doctor Name</label>
                <input type="text" class="form-control mt-1" id="specialization" name="specialization"
                    value="{{ $specialization->specialization ?? '' }}" required>
                <span id="specialization_error" class="error-message"></span>
            </div>

            <button id="addSpecialization" class="btn btn-primary btn-lg btn-block btn-success my-3" type="submit">
                {{ isset($specialization) ? 'Update Specialization' : 'Add Specialization' }}
            </button>
        </form>
    </div>



@endsection


@section('scripts')
    <script>
        $('#addSpecialization').click(function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = $('.addSpecializationForm').serialize();
            var route = "{{ isset($specialization) ? route('specializations.update', $specialization->id) : route('specializations.store') }}";
            var type = "{{ isset($specialization) ? 'PUT' : 'POST' }}";
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
                        toastr.success("dsfsdafadsfads");
                        setTimeout(function() {
                            window.location.href = "{{ route('specializations.index') }}";
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
