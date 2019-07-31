<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

        /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
      'id',
    ];


    /**
     * Fillable fields for an Employee.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'user_id',
        'job_title',
        'responsability',
        'salary',
    ];
 
    /**
     * An Employee belongs to a business.
     *
     * @return mixed
     */
    

    public function business()
    {
        return $this->belongsTo('App\Models\Business');
    }

    /**
     * An Employee belongs to an user.
     *
     * @return mixed
     */

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function isEmployeeHere($id) {
        if ($this->business->id == $id)
            return true;
        return false;
    }
}
