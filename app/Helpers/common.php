<?php

use Illuminate\Support\Facades\Auth;

if(!function_exists('checkGuard')) {
    function checkGuard($guard)
        {
            switch ($guard) {
                case Auth::guard('admin')->check():
                    $guard = 'admin';
                    break;
                case Auth::guard('doctor')->check():
                    $guard = 'doctor';
                    break;
                case Auth::guard('patient')->check():
                    $guard = 'patient';
                break;
                default:
                $guard =  'admin';
                return $guard;
            }
        }
}
