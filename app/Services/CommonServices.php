<?php
namespace App\Services;

use App\user;
use Auth;

class CommonServices {


	public function newOrders(){
		return auth()->user()->unreadNotifications()->whereType('App\Notifications\NewBooking')->count();
	}

	public function newInqueries(){
		return auth()->user()->unreadNotifications()->whereType('App\Notifications\NewInquery')->count();
	}
	public function cards(){
		return CreditCard::whereUserId(auth()->user()->getUser()->id)->get();
	}

}