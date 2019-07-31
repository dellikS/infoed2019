<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LegalController extends Controller
{
    public function index(){
        return view('legals.general');
    }

    public function cookies(){
        return view('legals.cookies');
    }

    public function privacy(){
        return view('legals.privacy');
    }
}
