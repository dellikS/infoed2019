<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * delete a specific notification
     *
     * @param $notif
     * @return mixed
     */
    public function delete($which) {
        if ($which === "all"){
            Auth::user()->notifications()->delete();
            return back(); 
        } else {
        $notification = Auth::user()->notifications()->findOrFail($which);
        $notification->delete();
        return back(); 
        }
    }

    public function read($which) {
        if ($which === "all"){
            Auth::user()->unreadNotifications->markAsRead();
            return back();
        } else {
        $notification = Auth::user()->unreadNotifications()->findOrFail($which);
        $notification->markAsRead();
        return back(); 
        }
    }

}
