<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Project;
use Auth;
use OwenIt\Auditing\Contracts\Auditable;

class Business extends Model implements Auditable
{
    use SoftDeletes;
    use CacheQueryBuilder;
    use \OwenIt\Auditing\Auditable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'businesses';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'motd',
        'hiring',
        'vacancies',
        'currency',
        'address',
        'email',
        'phone',
        'fax',
        'website',
        'country_id',
        'type',
    ];

    protected $dates = [
        'deleted_at',
    ];


    protected $auditInclude = [
        'name',
        'currency',
        'type',
        'motd',
    ];

    /**
     * A profile belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // User Profile Setup - SHould move these to a trait or interface...

    public function project()
    {
        return $this->hasOne('App\Models\Project', 'business_id');
    }

    public function rating()
    {
        return $this->hasMany('App\Models\BusinessRating', 'business_id');
    }

    public function survey()
    {
        return $this->hasOne('App\Models\BusinessSurvey', 'business_id');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\UserApplication', 'business_id');
    }

    public function application()
    {
        return $this->hasOne('App\Models\UserApplication', 'business_id');
    }

    public function employee()
    {
        return $this->hasMany('App\Models\Employee', 'business_id');
    }

    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id');
    }

    public function isOwnerHere()
    {
        if ($this->user->id == Auth::user()->id)
            return true;
        return false;
    }

    public function getStarRating()
    {
        $scoreCount = $this->rating()->count(); 
        if (empty($scoreCount)) {
            return 0;
        }

        $scoreSum = $this->rating()->sum('score');
        $average = $scoreSum / $scoreCount;

        return $average;
    }
}
