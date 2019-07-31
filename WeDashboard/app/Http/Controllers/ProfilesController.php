<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserAccount;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserProfile;
use App\Models\Profile;
use App\Models\Country;
use App\Models\Business;
use App\Models\User;
use App\Notifications\SendGoodbyeEmail;
use App\Traits\CaptureIpTrait;
use OwenIt\Auditing\Models\Audit;
use File;
use Auth;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Image;
use jeremykenedy\Uuid\Uuid;
use Carbon\Carbon;
use Validator;
use View;

class ProfilesController extends Controller
{
    protected $idMultiKey = '618423'; //int
    protected $seperationKey = '****';

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
     * Fetch user
     * (You can extract this to repository method).
     *
     * @param $username
     *
     * @return mixed
     */
    public function getUserByUsername($username)
    {
        return User::with('profile')->wherename($username)->firstOrFail();
    }

    /**
     * Display the specified resource.
     *
     * @param string $username
     *
     * @return Response
     */
    public function show($username)
    {
        try {
            $user = $this->getUserByUsername($username);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        if ($user->employee) {
        $employer = Business::find($user->employee->business_id);
        }

        if ($user->profile) {
        $country = Country::find($user->profile->country_id);
        ////////////////////////////////////////////////////////
        $dateformat = Carbon::parse($user->profile->birth_date);
        $birthdate = $dateformat->format('d/m/Y');
        $age =  $dateformat->age;
        ////////////////////////////////////////////////////////
        }

        $data = ['user' => $user];
        if ($user->profile)
        $data = Arr::collapse([$data, ['country' => $country, 'birthdate' => $birthdate, 'age' => $age]]);
        
        if ($user->employee)
        $data = Arr::collapse([$data, ['employer' => $employer]]);
        

        return view('profiles.show')->with($data);
    }

    public function logs($username)
    {

        try {
            $user = $this->getUserByUsername($username);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $audits = Audit::where('auditable_id', $user->id)->where('event', 'updated')->where('auditable_type', 'App\Models\User')->orderBy('id', 'desc')->paginate(5);

        $data = [
            'user'          => $user,
            'audits'        => $audits,
        ];

        if (Auth::user()->isAdmin() || Auth::user()->id == $user->id) {
            return view('profiles.logs')->with($data);
        } else {
            return redirect('home')->with('error', trans('profile.notYourProfile'));
        }

    }

    /**
     * /profiles/username/edit.
     *
     * @param $username
     *
     * @return mixed
     */
    public function edit($username)
    {
        try {
            $user = $this->getUserByUsername($username);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        if ($user->profile) {
            $dateformat = Carbon::parse($user->profile->birth_date);
            $birthdate = $dateformat->format('d/m/Y');

            $data = [
                'user'         => $user,
                'birthdate'    => $birthdate,
            ];

        } else {

        $data = [
            'user'         => $user,
        ];

        }   
        if (Auth::user()->id == $user->id) {
            return view('profiles.edit')->with($data);
        } else {
            return redirect('profile/'.Auth::user()->name.'/edit')->with('error', trans('profile.notYourProfile'));
        }
    }

    /**
     * Update a user's profile.
     *
     * @param \App\Http\Requests\UpdateUserProfile $request
     * @param $username
     *
     * @throws Laracasts\Validation\FormValidationException
     *
     * @return mixed
     */
    public function update(UpdateUserProfile $request, $username)
    {
        try {
            $user = $this->getUserByUsername($username);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $input = Input::only('address', 'country_id', 'bio', 'twitter_username', 'github_username', 'avatar_status');
        $input_birthDate = Input::get('birth_date');
        $birthDate = Carbon::createFromFormat('d/m/Y', $input_birthDate);

        $ipAddress = new CaptureIpTrait();

        if ($user->profile == null) {
            $profile = new Profile();
            $profile->birth_date = $birthDate;
            $profile->fill($input);
            $user->profile()->save($profile);
        } else {
            $user->profile->birth_date = $birthDate;
            $user->profile->fill($input)->save();
        }

        $user->updated_ip_address = $ipAddress->getClientIp();
        $user->save();

        return redirect('profile/'.$user->name.'/edit')->with('success', trans('profile.updateSuccess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserAccount(Request $request, $id)
    {
        $currentUser = \Auth::user();
        $user = User::findOrFail($id);
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);
        $phoneCheck = ($request->input('phone') != '') && ($request->input('phone') != $user->phone);
        $ipAddress = new CaptureIpTrait();
        $rules = [];

        if ($user->name != $request->input('name')) {
            $usernameRules = [
                'name' => ['required','regex:/^[[:alnum:]]+(?:[-_]?[[:alnum:]]+)*$/','max:255','unique:users'],
            ];
        } else {
            $usernameRules = [
                'name' => ['required','regex:/^[[:alnum:]]+(?:[-_]?[[:alnum:]]+)*$/','max:255'],
            ];
        }
        if ($emailCheck) {
            $emailRules = [
                'email' => 'email|max:255|unique:users',
            ];
        } else {
            $emailRules = [
                'email' => 'email|max:255',
            ];
        }
        if ($phoneCheck) {
            $phoneRules = [
                'phone' => ['required', 'regex:/^\(?\d{2,4}\)?[\d\s-]+$/', 'unique:users','min:3','max:16'],
            ];
        } else {
            $phoneRules = [
                'phone' => ['required', 'regex:/^\(?\d{2,4}\)?[\d\s-]+$/','min:3','max:16'],
            ];
        }
        $additionalRules = [
            'first_name' => ['required','regex:/^([A-Z]{1}[a-z]{1,30}[- ]{0,1}|[A-Z]{1}[- \']{1}[A-Z]{0,1}[a-z]{1,30}[- ]{0,1}|[a-z]{1,2}[- \']{1}[A-Z]{1}[a-z]{1,30}){1,3}+$/','min:3','max:32'],
            'last_name' => ['required','regex:/^[A-Z]{1}[a-z]{1,30}+$/','min:3','max:32'],
            
        ];

        $rules = array_merge($usernameRules, $emailRules, $phoneRules, $additionalRules);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($phoneCheck) {
            $user->phone = $request->input('phone');
            }

        $user->updated_ip_address = $ipAddress->getClientIp();

        $user->save();

        return redirect('profile/'.$user->name.'/edit')->with('success', trans('profile.updateAccountSuccess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateUserPasswordRequest $request
     * @param int                                          $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserPassword(UpdateUserPasswordRequest $request, $id)
    {
        $currentUser = \Auth::user();
        $user = User::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        if (!(Hash::check($request->input('current_password'), Auth::user()->password))) {
            return redirect('profile/'.$user->name.'/edit')->with('error', trans('Your current password does not matches with the password you provided. Please try again.'));
        }

        if(strcmp($request->input('current_password'), $request->input('password')) == 0){
            return redirect('profile/'.$user->name.'/edit')->with('error', trans('New Password cannot be same as your current password. Please choose a different password.'));
        }

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->updated_ip_address = $ipAddress->getClientIp();
        $user->save();

        return redirect('profile/'.$user->name.'/edit')->with('success', trans('profile.updatePWSuccess'));
    }

    /**
     * Upload and Update user avatar.
     *
     * @param $file
     *
     * @return mixed
     */
    public function upload()
    {
        if (Input::hasFile('file')) {
            $currentUser = \Auth::user();
            $avatar = Input::file('file');
            $filename = 'avatar.'.$avatar->getClientOriginalExtension();
            $save_path = storage_path().'/users/id/'.$currentUser->id.'/uploads/images/avatar/';
            $path = $save_path.$filename;
            $public_path = '/images/profile/'.$currentUser->id.'/avatar/'.$filename;

            // Make the user a folder and set permissions
            File::makeDirectory($save_path, $mode = 0755, true, true);

            // Save the file to the server
            Image::make($avatar)->resize(300, 300)->save($save_path.$filename);

            // Save the public image path
            $currentUser->profile->avatar = $public_path;
            $currentUser->profile->save();

            return response()->json(['path' => $path], 200);
        } else {
            return response()->json(false, 200);
        }
    }

    /**
     * Show user avatar.
     *
     * @param $id
     * @param $image
     *
     * @return string
     */
    public function userProfileAvatar($id, $image)
    {
        return Image::make(storage_path().'/users/id/'.$id.'/uploads/images/avatar/'.$image)->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\DeleteUserAccount $request
     * @param int                                  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUserAccount(DeleteUserAccount $request, $id)
    {
        $currentUser = \Auth::user();
        $user = User::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        if ($user->id != $currentUser->id) {
            return redirect('profile/'.$user->name.'/edit')->with('error', trans('profile.errorDeleteNotYour'));
        }

        // Create and encrypt user account restore token
        $sepKey = $this->getSeperationKey();
        $userIdKey = $this->getIdMultiKey();
        $restoreKey = config('settings.restoreKey');
        $encrypter = config('settings.restoreUserEncType');
        $level1 = $user->id * $userIdKey;
        $level2 = urlencode(Uuid::generate(4).$sepKey.$level1);
        $level3 = base64_encode($level2);
        $level4 = openssl_encrypt($level3, $encrypter, $restoreKey);
        $level5 = base64_encode($level4);

        // Save Restore Token and Ip Address
        $user->token = $level5;
        $user->deleted_ip_address = $ipAddress->getClientIp();
        $user->save();

        // Send Goodbye email notification
        $this->sendGoodbyEmail($user, $user->token);

        // Soft Delete User

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

        // Clear out the session
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/login/')->with('success', trans('profile.successUserAccountDeleted'));
    }

    /**
     * Send GoodBye Email Function via Notify.
     *
     * @param array  $user
     * @param string $token
     *
     * @return void
     */
    public static function sendGoodbyEmail(User $user, $token)
    {
        $user->notify(new SendGoodbyeEmail($token));
    }

    /**
     * Get User Restore ID Multiplication Key.
     *
     * @return string
     */
    public function getIdMultiKey()
    {
        return $this->idMultiKey;
    }

    /**
     * Get User Restore Seperation Key.
     *
     * @return string
     */
    public function getSeperationKey()
    {
        return $this->seperationKey;
    }
}
