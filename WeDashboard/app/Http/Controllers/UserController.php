<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Business;
use App\Models\Employee;
use DB;
use OwenIt\Auditing\Models\Audit;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        $businesses = Business::all();
        $employees = Employee::orderBy('created_at', 'desc')->take(5)->get();
        $latestBusinesses = Business::withCount(['rating as average_rating' => function($query) {
            $query->select(DB::raw('coalesce(avg(score),0)'));
            }])->orderByDesc('average_rating')->take(5)->get();


        $data = [
            'users'    => $users,
            'businesses'  => $businesses,
            'latestBusinesses' => $latestBusinesses,
            'employees' => $employees,
        ];

        if ($user->isAdmin()) {
            return view('pages.admin.home')->with($data);
        }

        return view('pages.user.home')->with($data);
    }
}
