<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
            // If user is not logged in or doesn't have the right role,
            // redirect with a flash message.

            // Flash a message to the session indicating lack of permissions.
            // You can use the `->with()` method to flash data to the session.
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }

}