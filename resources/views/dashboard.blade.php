@extends('layouts.dashboard.master')

@section('title', 'Dashboard | Electronic Health Record')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-5 fw-normal text-uppercase fs-2">Dashboard</h1>
        @include('common.alert')
        {{-- @include('common.message-modal') --}}
        <div class="row mt-5">

            @php
                // $patient_tiles = ['Profile', 'Appointments', 'Book Appointment'];
                $patient_tiles = [
                    [
                        'title' => 'My profile',
                        'icon' => 'fa-solid fa-house',
                        'description' => 'Update Profile',
                        'url' => route('patients.edit', ['id' => Auth::user()->id]),
                    ],
                    [
                        'title' => 'My Appointments',
                        'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        'description' => ' View Appointment History ',
                        'url' => route('patients.appointments'),
                    ],
                    [
                        'title' => 'Book My Appointment',
                        'icon' => 'fas fa-calendar-plus fa-2x text-gray-300',
                        'description' => ' Book Appointment ',
                        'url' => route('patients.book-appointment'),
                    ],
                ];
                $admin_tiles = [
                    [
                        'title' => 'Manage Patients',
                        'icon' => 'fa-solid fa-house',
                        'description' => 'Manage Patients',
                        'url' => route('patients.index'),
                    ],
                    [
                        'title' => 'Manage Doctors',
                        'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        'description' => ' Manage Doctors ',
                        'url' => route('doctors.index'),
                    ],
                    [
                        'title' => 'Appointments',
                        'icon' => 'fas fa-calendar-plus fa-2x text-gray-300',
                        'description' => ' View Appointment History',
                        'url' => route('admin-appointments'),
                    ],
                ];
                $doctor_tiles = [
                    [
                        'title' => 'My profile',
                        'icon' => 'fa-solid fa-house',
                        'description' => 'Update Profile',
                        'url' => route('doctors.edit', ['id' => Auth::user()->id]),
                    ],
                    [
                        'title' => 'My Appointments',
                        'icon' => 'fas fa-calendar fa-2x text-gray-300',
                        'description' => ' View Appointment History ',
                        'url' => route('doctors.appointments'),
                    ],
                ];
                // $doctor_tiles = ['Profile', 'Appointments'];
                // $admin_tiles = ['Manage Patients', 'Manage Doctors', 'Appointments'];
            @endphp
            @if (Auth::user()->role_id == 1)
            @foreach ($admin_tiles as $admin_tile)
            <div class="col-xl-3 col-md-6 mb-4">
                <a class="text-decoration-none" href="{{ $admin_tile['url'] }}">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                        {{ $admin_tile['description'] }}
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $admin_tile['title']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="{{ $admin_tile['icon'] }}"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        @endforeach
            @endif
            @if (Auth::user()->role_id == 2)
                @foreach ($doctor_tiles as $doctor_tile)
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-decoration-none" href="{{ $doctor_tile['url'] }}">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                                {{ $doctor_tile['description'] }}
                                            </div>
                                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $doctor_tile['title']}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="{{ $doctor_tile['icon'] }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                @endforeach
            @endif
            @if (Auth::user()->role_id == 3)
                @foreach ($patient_tiles as $patient_tile)
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a class="text-decoration-none" href="{{ $patient_tile['url'] }}">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                                {{ $patient_tile['description'] }}
                                            </div>
                                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $patient_tile['title']}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="{{ $patient_tile['icon'] }}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                @endforeach
            @endif
        </div>
@endsection
