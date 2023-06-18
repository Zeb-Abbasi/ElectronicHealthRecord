@extends('layouts.auth')

@section('title', 'Electronic Health Record')

@section('content')

    <h3 class="mb-5 text-success">EHR | Register Patient</h3>
    <p class="text-secondary">Enter your personal details below:</p>
    <form action="">
        <div class="form-outline mb-2">
            <label class="form-label text-success" for="typeNameX-2">Full Name</label>
            <input type="text" id="typeNameX-2" class="form-control form-control-lg" />
        </div>

        <div class="form-outline mb-2">
            <label class="form-label text-success" for="typeAddressX-2">Address</label>
            <input type="text" id="typeAddressX-2" class="form-control form-control-lg" />
        </div>

        <div class="form-outline mb-2">
            <label class="form-label text-success" for="typeCityX-2">City</label>
            <input type="text" id="typeCityX-2" class="form-control form-control-lg" />
        </div>
        {{-- radio  --}}
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label text-success" for="inlineRadio1">1</label>
        </div>
        <div class="form-check form-check-inline mb-2">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label text-success" for="inlineRadio2">2</label>
        </div>
        <hr>

        <p class="text-secondary mt-3">Enter your account details below:</p>

        <div class="form-outline mb-2">
            <label class="form-label text-success" for="typeEmailX-2">Email</label>
            <input type="email" id="typeEmailX-2" class="form-control form-control-lg" />
        </div>
        <div class="form-outline mb-2">
            <label class="form-label text-success" for="typePasswordX-2">Password</label>
            <input type="password" id="typePasswordX-2" class="form-control form-control-lg" />
        </div>
        <div class="form-outline mb-2">
            <label class="form-label text-success" for="typePasswordX-2">Password Again</label>
            <input type="password" id="typePasswordX-2" class="form-control form-control-lg" />
        </div>
        <!-- Checkbox -->
        <div class="form-check d-flex justify-content-start mb-4">
            <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
            <label class="form-check-label ms-2 text-success" for="form1Example3"> Remember password
            </label>
        </div>

        <button class="btn btn-primary btn-lg btn-block btn-success mb-3" type="submit">Register</button>
    </form>

    <p class="text-secondary">Already have an account? <a class="text-success"
            href="{{ route('patient-login') }}">Log-in</a></p>

    <hr class="my-4">
    <div class="copyright text-secondary text-center">
        &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> EHR</span>. <span>All rights
            reserved</span>
    </div>

@endsection
