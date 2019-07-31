<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessDetails extends FormRequest
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
            'name'                  => ['required','regex:/^[A-Z]([a-zA-Z0-9]|[- @\.#&!])*$/', 'min: 3','max:32'],
            'description'           => ['required','regex:/^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'min: 3', 'max: 1500'],
            'motd'                  => ['nullable','regex:/^$|^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'min:3',  'max: 64'],
            'type'                  => ['required','regex:/^([A-Z]{1}[a-z]{1,30}[- ]{0,1}|[A-Z]{1}[- \']{1}[A-Z]{0,1}[a-z]{1,30}[- ]{0,1}|[a-z]{1,2}[- \']{1}[A-Z]{1}[a-z]{1,30}){1,3}+$/','min:3','max:32'],
            'currency'              => ['required','regex:/^[A-Z]{3}?$/'],
            'address'               => ['nullable','regex:/^$|^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'max: 255'],
            'email'                 => ['required','regex:/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'],
            'phone'                 => ['nullable','regex:/^$|^\(?\d{2,4}\)?[\d\s-]+$/', 'min:3','max:16'],
            'fax'                   => ['nullable','regex:/^$|^\(?\d{2,4}\)?[\d\s-]+$/', 'min:3','max:16'],
            'website'               => ['nullable','regex:/^$|^(([a-zA-Z]{1})|([a-zA-Z]{1}[a-zA-Z]{1})|([a-zA-Z]{1}[0-9]{1})|([0-9]{1}[a-zA-Z]{1})|([a-zA-Z0-9][a-zA-Z0-9-_]{1,61}[a-zA-Z0-9]))\.([a-zA-Z]{2,6}|[a-zA-Z0-9-]{2,30}\.[a-zA-Z]{2,3})$/'],
        ];
    }
}
