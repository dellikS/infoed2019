<?php

namespace App\Models;

use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasRoleAndPermission;
    use Notifiable;
    use SoftDeletes;
    use CacheQueryBuilder;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'activated',
        'token',
        'signup_ip_address',
        'signup_confirmation_ip_address',
        'signup_sm_ip_address',
        'admin_ip_address',
        'updated_ip_address',
        'deleted_ip_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activated',
        'token',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected $auditInclude = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    /**
     * User Profile Relationships.
     *
     * @var array
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    // User Profile Setup - SHould move these to a trait or interface...

    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile')->withTimestamps();
    }

    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->name == $name) {
                return true;
            }
        }

        return false;
    }

    public function assignProfile($profile)
    {
        return $this->profiles()->attach($profile);
    }

    public function removeProfile($profile)
    {
        return $this->profiles()->detach($profile);
    }

    public function rating()
    {
        return $this->hasOne('App\Models\BusinessRating');
    }

    public function business()
    {
        return $this->hasOne('App\Models\Business');
    }

    public function application()
    {
        return $this->hasOne('App\Models\UserApplication');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\UserApplication');
    }

    public function employee()
    {
        return $this->hasOne('App\Models\Employee');
    }

    public function answerer()
    {
        return $this->hasOne('App\Models\UserApplication', 'answerer_id');
    }
    // User Profile Setup - SHould move these to a trait or interface...

    public function businesses()
    {
        return $this->belongsToMany('App\Models\Business')->withTimestamps();
    }

    public function hasBusiness($id)
    {
        foreach ($this->businesses as $business) {
            if ($business->user_id == $id) {
                return true;
            }
        }

        return false;
    }

    public function assignBusiness($business)
    {
        return $this->businesses()->attach($business);
    }

    public function removeBusiness($business)
    {
        return $this->businesses()->detach($business);
    }
}
