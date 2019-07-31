<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectDetails extends FormRequest
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
            'details'               => ['required','regex:/^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'min: 3', 'max: 1500'],
            'instruction'           => ['required', 'min: 3', 'max: 2000'],
            'title'                 => ['required', "regex:/^[A-Za-z0-9\s\-_,\.;:()]+$/", 'min: 3', 'max: 32'],
            'deadline'              => 'required_with:deadline|date_format:d/m/Y|after:now|before:1 year',
            'budget'                => ['required_with:budget','regex:/^\d{1,9}+(\.\d{1,2})?$/'],
        ];
    }
}
