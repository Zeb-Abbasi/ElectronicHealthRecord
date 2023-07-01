@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="page-heading p-4 bg-light">
        <h2 class="text-success ">BETWEEN DATES | REPORTS</h2>
    </div>
    <div class="container-fluid mt-3 mb-5">
        <form id="dataForm" action="{{route('reports')}}" method="GET">

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
                Submit
            </button>

        </form>
    </div>

@endsection


