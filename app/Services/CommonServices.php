<?php
namespace App\Services;

use App\user;
use Auth;
use App\Itinerary;

class CommonServices {


	public function newOrders(){
		return auth()
		->user()
		->unreadNotifications()
		->whereType('App\Notifications\NewBooking')
		->count();
	}

	public function newInqueries(){
		return auth()
		->user()
		->unreadNotifications()
		->whereType('App\Notifications\NewInquery')
		->count();
	}
	public function newContactUs(){
		return auth()
		->user()
		->unreadNotifications()
		->whereType('App\Notifications\ContactUsNotification')
		->count();
	}

	public function cards(){
		return CreditCard::whereUserId(auth()
		->user()
		->getUser()
		->id)
		->get();
	}

	public function newContactMessages(){
		$data = auth()
		->user()
		->unreadNotifications()
		->whereType('App\Notifications\ContactUsNotification')
		->get();
		$new_contact = array();
		foreach($data as $d){
			$data_get = $d->data;
			$contacts = $data_get;
			foreach($contacts as $contact ){
		
				$new_contact[] = array(
					'notification_id' => $d['id'],
					'contact_id' => $contact['id'],
					'contact_msg' =>  substr($contact['message'],0,20)."...",
				);		
			}
		}
		
		return $new_contact;
	}

	public function newOrdersAll(){
		$data = auth()
		->user()
		->unreadNotifications()
		->whereType('App\Notifications\NewBooking')
		->get();
		
		
		$new_booking = array();
		foreach($data as $d){
			$data_get = $d->data;
			$orders = $data_get;
			foreach($orders as $order ){
				
				$itinerary_id =  $order['itinerary_id'];  
				$itinerary    = Itinerary::where('id',$itinerary_id)->first()->title;	
				$new_booking[] = array(
					'notification_id' => $d['id'],
					'order_id' => $order['id'],
					'itinerary_name' => $itinerary,
				);		
			}
		}
		
		return $new_booking;
	}

	public function newInqueriesAll(){
		$data = auth()
		->user()
		->unreadNotifications()
		->whereType('App\Notifications\NewInquery')
		->get();

		$new_inquery = array();
		foreach($data as $d){
			$data_get = $d->data;
			$inqueries = $data_get;
			foreach($inqueries as $inquery ){
					
				$new_inquery[] = array(
					'notification_id' => $d['id'],
					'inquery_id' => $inquery['id'],
					'inquery_msg' =>  substr($inquery['message'],0,20)."...",
				);		
			}
		}
		
		return $new_inquery;
	}
	
}