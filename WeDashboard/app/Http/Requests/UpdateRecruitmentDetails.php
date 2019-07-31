<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecruitmentDetails extends FormRequest
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
            'hiring' => 'boolean',
            'questions.*' => ['required','regex:/^[a-zA-Z0-9,.!? ]*$/','string','min: 3','max:255'],
        ];
    }
}
