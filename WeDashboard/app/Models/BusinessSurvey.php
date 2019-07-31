<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessSurvey extends Model
{

      /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_surveys';

        /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
      'id',
    ];

    protected $casts = [
        'questions' => 'array',
    ];

    /**
     * Fillable fields for a Business.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'questions',
    ];

}
