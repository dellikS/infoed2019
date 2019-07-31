<?php

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use App\Models\Country;

class CountryComposer
{
    private $countries;
    private $translations;

    public function compose(View $view)
    {
        if (!$this->countries) {
            $this->countries = Country::all();
        }

        if (!$this->translations) {
            $this->translations =  Country::where('translated', true)->get();
        }

        $data = [
            'country_array'       => $this->countries,
            'translation_array'   => $this->translations,

        ];

        return $view->with($data);
    }
}