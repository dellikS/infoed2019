<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use App\Models\Business;
use Closure;

class CheckRecruitment
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
        $id = $request->segments()[1];
        $business = Business::findOrFail($id);

        foreach ($request->user()->applications as $application) {
            if ($application->business_id == $business->id && $application->status === null)
                return redirect('businesses/')->with('error', 'You can apply only once to each business');
        }

        if ($business->hiring == false || $request->user()->employee || !$business->survey)
            return redirect('businesses/')->with('error', 'You cannot apply here!');
            
        return $next($request);
    }
}
