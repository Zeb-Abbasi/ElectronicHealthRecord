<?php

use Illuminate\Support\Facades\Auth;

if(!function_exists('checkGuard')) {
    $guard = null;
    function checkGuard($guard)
        {
            switch ($guard) {
                case ('admin'):
                    return  Auth::guard('admin')->check();
                    break;
                case ('doctor'):
                    return  Auth::guard('doctor')->check();
                    break;
                case ('patient'):
                    return  Auth::guard('patient')->check();
                    break;
            }
        }
}
