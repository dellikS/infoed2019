<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Support\Database\CacheQueryBuilder;

class Profile extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use CacheQueryBuilder;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

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
        'location',
        'bio',
        'country_id',
        'address',
        'gender',
        'birth_date',
        'twitter_username',
        'github_username',
        'avatar',
        'avatar_status',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected $auditInclude = [
        'bio',
        'country_id',
        'address',
        'twitter_username',
        'github_username',
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

    public function country()
    {
        return $this->hasOne('App\Models\Country');
    }
}
