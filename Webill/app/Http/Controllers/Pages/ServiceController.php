<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index(){
        return view('pages.webill');
    }
  
    public function webill(){
        return view('pages.webill');
    }

    public function webiz(){
        return view('pages.webiz');
    }
}
