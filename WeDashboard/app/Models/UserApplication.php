<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserApplication extends Model

{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_applications';

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
        'answers'   => 'array',
    ];

    /**
     * Fillable fields for a Business.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'user_id',
        'questions',
        'answers',
        'status',
        'answerer_id',
        'answer_date',
        'reason',
    ];

    protected $dates = [
        'answer_date',
    ];

    /**
     * A application belongs to a user and business.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function business()
    {
        return $this->belongsTo('App\Models\Business');
    }

    public function answerer()
    {
        return $this->belongsTo('App\Models\User');
    }
}