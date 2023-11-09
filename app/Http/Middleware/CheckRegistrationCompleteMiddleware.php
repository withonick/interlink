<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationCompleteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (is_null(auth()->user()->gender && auth()->user()->hobbies()->count() === 0 &&
        auth()->user()->firstname && auth()->user()->surname && auth()->user()->birthdate)){
            return redirect()->route('index');
        }

        return $next($request);
    }
}
