<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user has the required role
        if (Auth::user()->hasRole($role)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
