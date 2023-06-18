@extends('layouts.auth')

@section('title', 'Electronic Health Record')

@section('content')

    <h3 class="mb-5 text-success">EHR | Forgot Password</h3>
    <form action="">
        <div class="form-outline mb-2">
            <label class="form-label text-success" for="typeEmailX-2">Email</label>
            <input type="email" id="typeEmailX-2" class="form-control form-control-lg" />
        </div>

        <button class="btn btn-primary btn-lg btn-block btn-success mt-3" type="submit">Reset Password</button>
    </form>
    <hr class="my-4">


    <div class="copyright text-secondary text-center">
        &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> EHR</span>. <span>All rights
            reserved</span>
    </div>
@endsection
