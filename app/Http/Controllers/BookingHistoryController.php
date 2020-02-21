<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Builder;
use Softon\Indipay\Facades\Indipay; 
use Validator;
use App\Itinerary;
use App\Destination;
use App\Activity;
use App\Currency;
use App\User;
use App\Booking;
use App\Transections;
use Auth;

class BookingHistoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $booking_history = Booking::with('itinerary','transection','currency')
        ->where('user_id',Auth::user()->id)
        ->whereNotNull('tracking_booking_id')
        ->whereNull('deleted_at')
        ->orderBy('id','desc')
        ->get();

        return view('bookingHistory',compact('booking_history'));
    }

    public function bookingDetails(Request $request, $order_id){
        $booking_detail = Booking::with('itinerary','transection','currency')
        ->where('user_id',Auth::user()->id)
        ->where('booking_id', $order_id)
        ->whereNull('deleted_at')
        ->first();

        return view('bookingDetails',compact('booking_detail'));
    }

    public function transectionHistory(Request $request){
        $transections = Transections::where('user_id',Auth::user()->id)
        ->whereNull('deleted_at')
        ->orderBy('id','desc')
        ->paginate(10);

        return view('transectionsHistory',compact('transections'));
    }
}
