<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            if ($guard == 'admin' && Auth::guard($guard)->check()) {
                return redirect()->route('admin.dashboard');
            }
            if ($guard == 'customer' && Auth::guard($guard)->check()) {
                return redirect()->route('customer.dashboard');
            }
            if ($guard == 'web' && Auth::guard($guard)->check()) {
                return redirect()->route('user.dashboard');
            }
        }

        return $next($request);
    }
}
