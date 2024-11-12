<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'mentor') {
            return $next($request);
        }

        return redirect('/home')->with('error', "You don't have access to this page.");
    }
}
