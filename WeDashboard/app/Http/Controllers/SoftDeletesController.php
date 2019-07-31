<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use App\Models\Country;

class SoftDeletesController extends Controller
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
     * Get Soft Deleted User.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDeletedUser($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->get();
        if (count($user) != 1) {
            return false;
        }

        return $user[0];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::onlyTrashed()->get();
        $roles = Role::all();

        return View('usersmanagement.show-deleted-users', compact('users', 'roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = self::getDeletedUser($id);

        if ($user === false) {
            return redirect('/users/deleted')->with('error', trans('usersmanagement.errorUserNotFound'));
        } 

        
        if ($user->profile) {
            $country = Country::find($user->profile->country_id);

            $data = [
                'user'         => $user,
                'country'  => $country,
            ];

        } else {

        $data = [
            'user'         => $user,
        ];

        } 

        return view('usersmanagement.show-deleted-user')->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = self::getDeletedUser($id);

        if ($user === false) {
            return redirect('/users/deleted')->with('error', trans('usersmanagement.errorUserNotFound'));
        } 

        $user->restore();

        return redirect('/users/')->with('success', trans('usersmanagement.successRestore'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = self::getDeletedUser($id);

        if ($user === false) {
            return redirect('/users/deleted')->with('error', trans('usersmanagement.errorUserNotFound'));
        } 

        $user->forceDelete();

        return redirect('/users/deleted/')->with('success', trans('usersmanagement.successDestroy'));
    }
}
