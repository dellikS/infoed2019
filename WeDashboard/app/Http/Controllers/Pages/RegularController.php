<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegularController extends Controller
{
     public function github(){
        return redirect('https://github.com/dellikS/infoed2019');
    }
    public function youtube(){
        return redirect('https://youtube.com/dellikS/');
    }
    public function facebook(){
        return redirect('https://facebook.com/novacdan.ro');
    }
    public function instagram(){
        return redirect('https://instagram.com/novacdan02');
    }
}
