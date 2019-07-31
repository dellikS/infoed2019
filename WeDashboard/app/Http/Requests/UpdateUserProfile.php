<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfile extends FormRequest
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
            'address'          => ['nullable', 'min: 10','regex:/^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'max: 255'],
            'bio'              => ['nullable','regex:/^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'max: 255'],
            'country_id'       => ['required','integer','between:1,110'],
            'birth_date'       => 'required|date_format:d/m/Y|after:-100 years|before:18 years ago',
            'twitter_username' => 'max:50',
            'github_username'  => 'max:50',
            'avatar'           => '',
            'avatar_status'    => '',
        ];
    }
}
