<?php

namespace App\Http\Middleware;

use Closure;

class CheckOwnsBusiness
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
        if ($request->user()->business) {
            return redirect('/businesses')->with('error', 'You already own a business');
        }
        return $next($request);
    }
}
