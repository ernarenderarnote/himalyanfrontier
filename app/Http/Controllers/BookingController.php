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

class BookingController extends Controller
{

    private $merchant_id  = '';
    private $redirect_url = '';
    private $cancel_url   = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->merchant_id  = '';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->activity_id){
            $activity_id = $request->activity_id;
        }else{
            $activity_id = session()->get('activity_id');     
        }
        
        $itinerary = Itinerary::with('schedule')->where('id',$activity_id)->first();
        
        $user      = User::with('profile')->where('id',Auth::user()->id)->first();
        
        session(['activity_id' => $activity_id]);   
        
        return view('booking',compact('itinerary','user'));
    }

    public function makePayment(Request $request){
        $messages = [
            'name.*.required'    => 'Full Name is required.',
            'mobile.*.required'  => 'Mobile is required.',
            'mobile.*.numeric'   => 'Mobile must be valid number.',
            'age.*.required'     => 'Age is required.',
            'age.*.numeric'      => 'Age must be in numbers.',
            'gender.*.required'  => 'Gender is required.',
            'email.*.required'   => 'Email is required.',
            'email.*.email'      => 'Email must be a valid email.', 
            'height.*.required'  => 'Height is required.',
            'height.*.numeric'   => 'Height must be in numbers.' ,
            'weight.*.required'  => 'Weight is required.',
            'weight.*.numeric'   => 'Weight must be in numbers.',

        ];
        $validator = Validator::make($request->all(), [
            'booking_date' => 'required',
            'name.*' => 'required',
            'mobile.*' => 'required|numeric',
            'age.*' => 'required|numeric',
            'gender.*' => 'required',
            'email.*' => 'required|email',
            'height.*' => 'required|numeric',
            'weight.*' => 'required|numeric',
            'state' => 'required',
            'city' => 'required',
            'pin_code' => 'required|numeric',
            'source' => 'required',
            'travelexperiance' => 'required',
            'agree' => 'required',
        ], $messages);
        

        if($validator->fails()) {
            $response['error'] = $validator->errors()->all();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $itinerary       = Itinerary::where('id', $request->activity_id)->first(['id','price']);
            $converted_price = $itinerary->converted_price;
            $actual_currecny = $itinerary->currency_id;
            $actual_price    = $itinerary->price;
            if($request->payment_percentage == 'partial'){
                $paid_amount      = ($actual_price/100)*20;
                $remaining_amount = ($actual_price/100)*80; 
            }else{
                $paid_amount      = $actual_price;
                $remaining_amount = ''; 
            }
            $booking                     = new Booking();
            $booking->user_id            = Auth::user()->id;
            $booking->itinerary_id       = $request->activity_id;
            $booking->schedule_id        = $request->booking_date;
            $booking->booking_id         = uniqid();
            $booking->name               = json_encode($request->name);
            $booking->email              = json_encode($request->email);
            $booking->mobile             = json_encode($request->mobile);
            $booking->gender             = json_encode($request->gender);
            $booking->height             = json_encode($request->height);
            $booking->weight             = json_encode($request->weight);
            $booking->address            = $request->address;
            $booking->state              = $request->state;
            $booking->city               = $request->city;
            $booking->pin_code           = $request->pin_code;
            $booking->source             = $request->source;
            $booking->travelexperiance   = $request->travelexperiance;
            $booking->currency_id        = $request->currency_id;
            $booking->activity_price     = $request->activity_price;
            $booking->actual_price       = $actual_price;
            $booking->payment_percentage = $request->payment_percentage;
            $booking->no_of_participants = $request->additional_user + 1; 
            $booking->actual_currency    = $actual_currecny;
            $booking->payment_paid       = $paid_amount;
            $booking->remaining_payment  = $remaining_amount;
            $booking->booking_status     = 'pending';
            $booking->payment_status     = 'not_paid';
            if($booking->save()){
                $this->paymentRequest($booking);
            }
        }
    }

    private function paymentRequest($booking){
        $currency_code = Currency::where('id',$booking->currency_id)->first('code');
        $parameters = [
                
            'merchant_id' => 8376,

            'currency' => $currency_code,

            'redirect_url' =>  route('successPayment',['id',$booking->id]),
           
            'cancel_url' => route('failedPayment',['id',$booking->id]),

            'language' => 'English',

            'tid' => '1231455',

            'order_id' => $booking->order_id,

            'amount' => $booking->payment_paid,
            
        ];
        
        $order = Indipay::prepare($parameters);
        return Indipay::process($order);
    } 

    public function paymentSuccess(Request $request){
        $response = Indipay::response($request);
        echo"<pre>";
        print_r($response);
        die;
    }
   
    public function paymentFailed(Request $request){
       echo"<pre>";
       print_r($request->all());
       die;
    }
}
