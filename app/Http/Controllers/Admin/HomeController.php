<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\NewBooking;
use Auth;
use App\User;
use App\Booking;
use App\Inquery;
use App\Transections;

class HomeController
{
    public function index()
    {
        $new_orders = auth()->user()->unreadNotifications()
            ->whereType('App\Notifications\NewBooking')
            ->count();

        $bookings = Booking::whereNull('deleted_at')
                ->get()
                ->count();

        $inqueries = Inquery::whereNull('deleted_at')
                    ->get()
                    ->count();

        $users  = User::whereNull('deleted_at')
                ->get()
                ->count();

        $transections = Transections::whereNull('deleted_at')
                    ->get()
                    ->count(); 

        return view('admin.home',compact('bookings','users','inqueries','transections'));
    }
}
