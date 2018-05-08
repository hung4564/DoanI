<?php

namespace App\Http\Middleware;

use Closure;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->isAdmin()) {
                return $next($request);
            } else {
                return redirect(route('dashboard::index'));
            }
        } else {
          //flash()->error('Access Denied');
            return view('auth.login');
        }
    }
}
