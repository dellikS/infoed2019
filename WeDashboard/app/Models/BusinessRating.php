<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessRating extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_ratings';

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
        'business_id',
        'user_id',
        'score',
    ];

    public function business()
    {
        return $this->belongsTo('App\Models\Business');
    }
}
