<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployee extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'job_title'                 => ['required', "regex:/^[A-Za-z0-9\s\-_,\.;:()]+$/", 'min: 3', 'max: 32'],
            'responsability'            => ['required', "regex:/^[A-Za-z0-9\s\-_,\.;:()]+$/", 'min: 3', 'max: 32'],
            'salary'                    => ['required_with:salary','regex:/^$|^\d{1,9}+(\.\d{1,2})?$/'],
        ];
    }
}
