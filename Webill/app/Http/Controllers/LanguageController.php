<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;

use App\Http\Requests;

class LanguageController extends Controller
{
	public function index(Request $request)
	{
		$request->session()->put('locale', Input::get('locale'));
		return back();	
    }
    
}
