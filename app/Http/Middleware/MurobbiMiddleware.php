<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MurobbiMiddleware
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
        if (Auth::user()->role != "murobbi") {
            return redirect()->route('front.home');
        }
        return $next($request);
    }
}
