<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        $hasRole = false;

        foreach ($roles as $role) {
            if ($role === 'customer' && !is_null($user->customers_id)) {
                $hasRole = true;
                break;
            }
            if ($role === 'driver' && !is_null($user->drivers_id)) {
                $hasRole = true;
                break;
            }
            if ($role === 'admin' && !is_null($user->admins_id)) {
                $hasRole = true;
                break;
            }
        }

        if (!$hasRole) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
