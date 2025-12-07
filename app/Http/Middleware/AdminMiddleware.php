<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has the 'admin' role
        if (!auth()->check() || !auth()->user()->hasRole('admin')) {
            // Redirect to home or show 403 forbidden page
            return redirect('/')->with('error', 'You do not have permission to access the admin area.');
        }

        return $next($request);
    }
}
