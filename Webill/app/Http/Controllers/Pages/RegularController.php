<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegularController extends Controller
{
    public function index(){
        return view('pages.index');
    }


    public function wedash(){
        return redirect(config('app.second_url').'/login');
    }


    // Redirects:
    public function github(){
        return redirect('https://github.com/dellikS/infoed2019');
    }
    // End Redirects;
}

