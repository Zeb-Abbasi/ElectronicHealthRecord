@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="container-fluid mt-5">
        <form action="" method="POST">
            @csrf
        
            <div class="form-group mt-3">
                <label for="clinic_address">Doctor Clinic Address</label>
                <input type="text" class="form-control mt-1" id="clinic_address" name="clinic_address" required>
            </div>
        
            <div class="form-group mt-3">
                <label for="consultancy_fees">Doctor Consultancy Fees</label>
                <input type="text" class="form-control mt-1" id="consultancy_fees" name="consultancy_fees" required>
            </div>
        
            <div class="form-group mt-3">
                <label for="contact_no">Doctor Contact No</label>
                <input type="text" class="form-control mt-1" id="contact_no" name="contact_no" required>
            </div>
        
            <div class="form-group mt-3">
                <label for="email">Doctor Email</label>
                <input type="email" class="form-control mt-1" id="email" name="email" required>
            </div>
        
            <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control mt-1" id="password" name="password" required>
            </div>
        
            <div class="form-group mt-3">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control mt-1" id="password_confirmation" name="password_confirmation" required>
            </div>
        
            <button type="submit" class="btn btn-primary mt-3">Register</button>
        </form>
    </div>


    @endsection
    