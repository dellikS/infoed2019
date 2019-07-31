<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Traits\ActivationTrait;
use App\Traits\CaptchaTrait;
use Carbon\Carbon;
use App\Traits\CaptureIpTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use ActivationTrait;
    use CaptchaTrait;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/activate';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', [
            'except' => 'logout',
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function showRegistrationForm()
    {
        return view('auth.register_step.step_one');
    }

    protected function validator(array $data)
    {
        $data['captcha'] = $this->captchaCheck();

        if (!config('settings.reCaptchStatus')) {
            $data['captcha'] = true;
        }

        return Validator::make($data,
            [
                'name'                  => ['required','regex:/^[[:alnum:]]+(?:[-_]?[[:alnum:]]+)*$/','min:3','max:32','unique:users'],
                'first_name'            => ['required','regex:/^([A-Z]{1}[a-z]{1,30}[- ]{0,1}|[A-Z]{1}[- \']{1}[A-Z]{0,1}[a-z]{1,30}[- ]{0,1}|[a-z]{1,2}[- \']{1}[A-Z]{1}[a-z]{1,30}){1,3}+$/','min:3','max:32'],
                'last_name'             => ['required','regex:/^[A-Z]{1}[a-z]{1,30}+$/','min:3','max:32'],
                'email'                 => 'required|email|max:255|unique:users',
                'birth_date'            => 'required|date_format:d/m/Y|after:-100 years|before:18 years ago',
                'country_id'            => 'required|integer|between:1,110',
                'address'               => ['required', 'regex:/^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'max: 255'],
                'phone'                 => ['required', 'regex:/^\(?\d{2,4}\)?[\d\s-]+$/', 'unique:users','min:3','max:16'],
                'password'              => 'required|min:6|max:30|confirmed',
                'password_confirmation' => 'required|same:password',
                'g-recaptcha-response'  => '',
                'captcha'               => 'required|min:1',
            ],
            [
                'name.unique'                   => trans('auth.userNameTaken'),
                'name.required'                 => trans('auth.userNameRequired'),
                'first_name.required'           => trans('auth.fNameRequired'),
                'last_name.required'            => trans('auth.lNameRequired'),
                'email.required'                => trans('auth.emailRequired'),
                'email.email'                   => trans('auth.emailInvalid'),
                'password.required'             => trans('auth.passwordRequired'),
                'password.min'                  => trans('auth.PasswordMin'),
                'password.max'                  => trans('auth.PasswordMax'),
                'g-recaptcha-response.required' => trans('auth.captchaRequire'),
                'captcha.min'                   => trans('auth.CaptchaWrong'),
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $ipAddress = new CaptureIpTrait();
        $profile = new Profile();
        $role = Role::where('slug', '=', 'unverified')->first();
        $user = User::create([
                'name'              => $data['name'],
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'email'             => $data['email'],
                'phone'             => $data['phone'],
                'password'          => Hash::make($data['password']),
                'token'             => str_random(64),
                'signup_ip_address' => $ipAddress->getClientIp(),
                'activated'         => !config('settings.activation'),
            ]);
        
        $birthDate = Carbon::createFromFormat('d/m/Y', $data['birth_date']);
        $user->profile()->create([
                'user_id'           => $user->id,
                'country_id'        => $data['country_id'],
                'address'           => $data['address'],
                'birth_date'        => $birthDate,
        ]);

        $user->attachRole($role);
        $this->initiateEmailActivation($user);

        return $user;
    }
}
