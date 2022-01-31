<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @param string|null                                                                                       ...$guards
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        foreach ($guards as $guard) {
            switch ($guard) {
                case 'admin':
                    if (Auth::guard($guard)->check()) {
                        return redirect()->route('admin.dashboard');
                    }
                    break;
                    case 'seller':
                    if (Auth::guard($guard)->check()) {
                        return redirect()->route('seller.dashboard.index');
                    }
                    break;
                case 'customer':
                    if (Auth::guard($guard)->check()) {
                        return redirect()->route('home');
                    }
                    break;
                default:
                    if (Auth::guard($guard)->check()) {
                        return redirect('home');
                    }
                    break;
            }
        }

        return $next($request);
    }
}
