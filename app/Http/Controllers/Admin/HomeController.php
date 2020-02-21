<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\NewBooking;
use Auth;
use App\User;
class HomeController
{
    public function index()
    {
        $new_orders = auth()->user()->unreadNotifications()->whereType('App\Notifications\NewBooking')->count();
        
        return view('admin.home',compact($new_orders));
    }
}
