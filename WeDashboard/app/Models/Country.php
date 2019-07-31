<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

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
        'code',
        'name',
        'phonecode',
        'translated',
    ];
 
    /**
     * A profile belongs to a user.
     *
     * @return mixed
     */
    
    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    public function business()
    {
        return $this->belongsTo('App\Models\Business');
    }

}
