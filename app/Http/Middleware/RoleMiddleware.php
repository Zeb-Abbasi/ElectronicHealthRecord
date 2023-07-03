<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        // // Check if the user has the specified role
        // if ($user && $user->hasRole($role)) {
        //     return $next($request);
        // }

        // // Unauthorized access
        // return redirect()->route('dashboard');
        // Check if the authenticated user has one of the specified roles
        if (!in_array($user->role->name, $roles)) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
