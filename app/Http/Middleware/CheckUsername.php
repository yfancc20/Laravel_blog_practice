<?php

namespace App\Http\Middleware;

use Closure;

class CheckUsername
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
        // username must equals
        if ($request->route('user')->username != $request->user()->username) {
            return redirect('home');
        }
        return $next($request);
    }
}
