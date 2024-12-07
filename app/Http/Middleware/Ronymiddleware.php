<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Ronymiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    
    public function handle(Request $request, Closure $next)
    {
        // Your custom logic goes here
        // For example, you can check if a condition is met
        if ($request->user() && $request->user()->name !== 'rony') {
            // Redirect if the user is not 'rony'
            return redirect('home');
        }

        // Continue with the request
        return $next($request);
    }
}
