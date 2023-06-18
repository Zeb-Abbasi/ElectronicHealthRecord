@extends('layouts.auth')

@section('title', 'Electronic Health Record')

@section('content')

    <h3 class="mb-5 text-success">EHR | Reset Password</h3>
    <form action="">
        <div class="form-outline mb-3">
            <label class="form-label text-success" for="typePasswordX-2">New Password</label>
            <input type="password" id="typePasswordX-2" class="form-control form-control-lg" />
        </div>
        <div class="form-outline mb-4">
            <label class="form-label text-success" for="typePasswordX-2">Confirm Password</label>
            <input type="password" id="typePasswordX-2" class="form-control form-control-lg" />
        </div>

        <button class="btn btn-primary btn-lg btn-block btn-success" type="submit">Update</button>
    </form>

    <hr class="my-4">
    <div class="copyright text-secondary text-center">
        &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> EHR</span>. <span>All rights
            reserved</span>
    </div>

@endsection
