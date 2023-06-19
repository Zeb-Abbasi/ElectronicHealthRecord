@extends('layouts.auth')

@section('title', 'Electronic Health Record')

@section('content')

    <h3 class="mb-5 text-success">EHR | Admin Login</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- <form action="{{ route('auth-login') }}" method="POST"> --}}
        <form action="{{ route('adminLogin') }}" method="POST">
        @csrf <!-- Add CSRF token for security -->

        <div class="form-outline mb-2">
            <label class="form-label text-success" for="typeEmailX-2">Email</label>
            <input type="email" id="typeEmailX-2" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" />
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-outline mb-3">
            <label class="form-label text-success" for="typePasswordX-2">Password</label>
            <input type="password" id="typePasswordX-2" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" />
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Checkbox -->
        <div class="form-check d-flex justify-content-start mb-4">
            <input class="form-check-input" type="checkbox" value="" id="form1Example3" name="remember" />
            <label class="form-check-label ms-2 text-success" for="form1Example3"> Remember password
            </label>
        </div>

        <button class="btn btn-primary btn-lg btn-block btn-success" type="submit">Login</button>

    </form>
    <hr class="my-4">
    <div class="copyright text-secondary text-center">
        &copy; <span class="current-year"></span><span class="text-bold text-uppercase"> EHR</span>. <span>All rights
            reserved</span>
    </div>

@endsection
