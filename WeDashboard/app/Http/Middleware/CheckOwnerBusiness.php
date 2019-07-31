<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Business;
use Illuminate\Contracts\Auth\Guard;

class CheckOwnerBusiness
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


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

        if ($business->user_id !== $this->auth->getUser()->id) {
            return redirect('businesses/'.$business->id)->with('error', 'You are not the owner!');
        }

        return $next($request);
    }
}
