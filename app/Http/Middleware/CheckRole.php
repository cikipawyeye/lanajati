<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            Log::info('User not authenticated, redirecting to login.');
            return redirect('/login');
        }

        $user = Auth::user();
        Log::info('Authenticated user role: ' . $user->role);

        if ($user->role !== $role) {
            Log::info('User role does not match required role, redirecting to home.');
            return redirect('/home');
        }

        return $next($request);
    }
}

