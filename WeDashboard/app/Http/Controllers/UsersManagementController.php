<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;
use App\Models\Country;

class UsersManagementController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagintaionEnabled = config('usersmanagement.enablePagination');
        if ($pagintaionEnabled) {
            $users = User::paginate(config('usersmanagement.paginateListSize'));
        } else {
            $users = User::all();
        }
        $roles = Role::all();

        return View('usersmanagement.show-users', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        $data = [
            'roles' => $roles,
        ];

        return view('usersmanagement.create-user')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name'                  => ['required','regex:/^[[:alnum:]]+(?:[-_]?[[:alnum:]]+)*$/','max:255','unique:users'],
                'first_name'            => ['required','regex:/^([A-Z]{1}[a-z]{1,30}[- ]{0,1}|[A-Z]{1}[- \']{1}[A-Z]{0,1}[a-z]{1,30}[- ]{0,1}|[a-z]{1,2}[- \']{1}[A-Z]{1}[a-z]{1,30}){1,3}+$/','min:3','max:32'],
                'last_name'             => ['required','regex:/^[A-Z]{1}[a-z]{1,30}+$/','min:3','max:32'],
                'email'                 => ['required','regex:/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/','unique:users'],
                'phone'                 => ['required', 'regex:/^\(?\d{2,4}\)?[\d\s-]+$/', 'unique:users','min:3','max:16'],
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'role'                  => 'required',
                'country_id'            => 'required|integer|between:1,110',
            ],
            [
                'name.unique'         => trans('auth.userNameTaken'),
                'name.required'       => trans('auth.userNameRequired'),
                'first_name.required' => trans('auth.fNameRequired'),
                'last_name.required'  => trans('auth.lNameRequired'),
                'email.required'      => trans('auth.emailRequired'),
                'email.email'         => trans('auth.emailInvalid'),
                'password.required'   => trans('auth.passwordRequired'),
                'password.min'        => trans('auth.PasswordMin'),
                'password.max'        => trans('auth.PasswordMax'),
                'role.required'       => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $profile = new Profile();

        $user = User::create([
            'name'             => $request->input('name'),
            'first_name'       => $request->input('first_name'),
            'last_name'        => $request->input('last_name'),
            'email'            => $request->input('email'),
            'phone'            => $request->input('phone'),
            'password'         => bcrypt($request->input('password')),
            'token'            => str_random(64),
            'admin_ip_address' => $ipAddress->getClientIp(),
            'activated'        => 1,
        ]);

        $user->profile()->create([
            'country_id'        => $request->input('country_id'),
        ]);
        
        $user->attachRole($request->input('role'));
        $user->save();

        return redirect('users')->with('success', trans('usersmanagement.createSuccess'));
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
        $user = User::findOrFail($id);

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

        return view('usersmanagement.show-user')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        foreach ($user->roles as $user_role) {
            $currentRole = $user_role;
        }

        $data = [
            'user'        => $user,
            'roles'       => $roles,
            'currentRole' => $currentRole,
        ];

        return view('usersmanagement.edit-user')->with($data);
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
        $currentUser = Auth::user();
        $user = User::findOrFail($id);
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);
        $phoneCheck = ($request->input('phone') != '') && ($request->input('phone') != $user->phone);
        $ipAddress = new CaptureIpTrait();

        if ($emailCheck && $phoneCheck) {
            $validator = Validator::make($request->all(), [
                'name'     => ['required','regex:/^[[:alnum:]]+(?:[-_]?[[:alnum:]]+)*$/','max:255','unique:users'],
                'first_name'=> ['required','regex:/^([A-Z]{1}[a-z]{1,30}[- ]{0,1}|[A-Z]{1}[- \']{1}[A-Z]{0,1}[a-z]{1,30}[- ]{0,1}|[a-z]{1,2}[- \']{1}[A-Z]{1}[a-z]{1,30}){1,3}+$/','min:3','max:32'],
                'last_name'=> ['required','regex:/^[A-Z]{1}[a-z]{1,30}+$/','min:3','max:32'],
                'phone'    => ['required', 'regex:/^\(?\d{2,4}\)?[\d\s-]+$/', 'unique:users','min:3','max:16'],
                'email'    => 'email|max:255|unique:users',
                'country_id'=> 'integer|between:1,110',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name'     => ['required','regex:/^[[:alnum:]]+(?:[-_]?[[:alnum:]]+)*$/','max:255','unique:users,name,'.$id],
                'email'    => ['required','regex:/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/','unique:users,name,'.$id],
                'first_name'=> ['required','regex:/^([A-Z]{1}[a-z]{1,30}[- ]{0,1}|[A-Z]{1}[- \']{1}[A-Z]{0,1}[a-z]{1,30}[- ]{0,1}|[a-z]{1,2}[- \']{1}[A-Z]{1}[a-z]{1,30}){1,3}+$/','min:3','max:32'],
                'last_name'=> ['required','regex:/^[A-Z]{1}[a-z]{1,30}+$/','min:3','max:32'],
                'phone'    => ['required', 'regex:/^\(?\d{2,4}\)?[\d\s-]+$/', 'unique:users,name,'.$id,'min:3','max:16'],
                'password' => 'nullable|confirmed|min:6',
                'country_id'=> 'integer|between:1,110',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->profile->country_id = $request->input('country_id');

       
        if ($phoneCheck) {
        $user->phone = $request->input('phone');
        }

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }

        $userRole = $request->input('role');
        if ($userRole != null) {
            $user->detachAllRoles();
            $user->attachRole($userRole);
        }

        $user->updated_ip_address = $ipAddress->getClientIp();

        switch ($userRole) {
            case 3:
                $user->activated = 0;
                break;

            default:
                $user->activated = 1;
                break;
        }

        $user->profile->save();
        $user->save();

        return back()->with('success', trans('usersmanagement.updateSuccess'));
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
        $currentUser = Auth::user();
        $user = User::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        if ($user->id != $currentUser->id) {
            $user->deleted_ip_address = $ipAddress->getClientIp();
            $user->save();

            $user->delete();
            if ($user->business) {
                $user->business->delete();
                if ($user->business->project) {
                    $user->business->project->delete();
                }
                if ($user->business->survey) {
                    $user->business->survey->delete();
                }
                if ($user->business->employee) {
                    foreach ($user->business->employee as $employees)
                    $employees->delete();
                }     
                if ($user->business->rating) {
                    foreach ($user->business->rating as $ratings)
                    $ratings->delete();
                }      
            }
            if ($user->employee) {
                $user->employee->delete();
            }   

            return redirect('users')->with('success', trans('usersmanagement.deleteSuccess'));
        }

        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }

    /**
     * Method to search the users.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('user_search_box');
        $searchRules = [
            'user_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'user_search_box.required' => 'Search term is required',
            'user_search_box.string'   => 'Search term has invalid characters',
            'user_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = User::where('id', 'like', $searchTerm.'%')
                            ->orWhere('name', 'like', $searchTerm.'%')
                            ->orWhere('email', 'like', $searchTerm.'%')->get();

        // Attach roles to results
        foreach ($results as $result) {
            $roles = [
                'roles' => $result->roles,
            ];
            $result->push($roles);
        }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
