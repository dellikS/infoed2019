<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Database\CacheQueryBuilder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use CacheQueryBuilder;
    use SoftDeletes;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_projects';

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
        'title',
        'details',
        'instruction',
        'currency',
        'budget',
        'deadline',
        'status',
    ];

    protected $dates = [
        'deleted_at',
        'deadline',
    ];

    /**
     * A profile belongs to a user.
     *
     * @return mixed
     */

    public function business()
    {
        return $this->belongsTo('App\Models\Business');
    }

}
