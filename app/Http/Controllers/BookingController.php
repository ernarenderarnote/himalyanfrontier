<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Builder;
use Softon\Indipay\Facades\Indipay; 
use App\Notifications\NewBooking;
use Validator;
use App\Itinerary;
use App\ItinerarySchedule;
use App\Destination;
use App\Activity;
use App\Currency;
use App\User;
use App\Booking;
use App\Transections;
use App\PaymentSettings;
use Auth;

class BookingController extends Controller
{

    private $merchant_id    = '';
    private $redirect_url   = '';
    private $cancel_url     = '';
    private $booking_series = ''; 
    private $bank_charges   = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->merchant_id       = '';
        $this->booking_series    = 1000; 
        $this->bank_charges      = 3.07;
        $this->partial_payment   = 20;
        $this->remaining_payment = 100 - $this->partial_payment;

        $payment_settings = PaymentSettings::first();
        if(!is_null($payment_settings)){
            $this->bank_charges      = $payment_settings->bank_charges;
            $this->partial_payment   = $payment_settings->partial_payment;
            $this->remaining_payment = 100 - $this->partial_payment;
        }
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

        $bank_charges      = $this->bank_charges;

        $partial_payment   = $this->partial_payment;

        $remaining_payment = $this->remaining_payment;

        $request->flash();
        
        return view('booking',compact('itinerary','user','bank_charges','partial_payment','remaining_payment'));
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
            $booking = $this->storeNewBookings($request);
            if( !empty($booking) ){
                $itinerary       = Itinerary::where('id',  $booking->itinerary_id)->first(['id','price','currency_id']);
        
                $converted_price = $itinerary->converted_price;
                
                $actual_currecny = $itinerary->currency_id;
            
                $actual_price    = $itinerary->price;

                $itinerary_id    = base64_encode($booking->itinerary_id);
                if( $request->payment_percentage == 'partial' ){
                    $participant        = $booking->no_of_participants;
                    $paid_amount        = ($participant * $converted_price/100) * $this->partial_payment;
                    $bank_charges       = ($paid_amount/100) * $this->bank_charges;
                    $paid_amount        = $paid_amount + $bank_charges;
                    $remaining_amount   = ($participant * $converted_price/100) * $this->remaining_payment;
                    $bank_charges       = ($remaining_amount/100)*$this->bank_charges; 
                    $remaining_amount   = $remaining_amount + $bank_charges;
                    $payment_percentage = $this->partial_payment;
                    $payment_method     = base64_encode('partial');
                    $booking_status     = base64_encode('partial_completed');
                
                }else{
                    $participant        = $booking->no_of_participants;
                    $paid_amount        = $participant * $converted_price;
                    $bank_charges       = ($paid_amount/100) * $this->bank_charges;
                    $paid_amount        = $paid_amount + $bank_charges;
                    $remaining_amount   = 0; 
                    $payment_percentage = 100;
                    $payment_method     = base64_encode('full_payment');
                    $booking_status     = base64_encode('completed');
                
                }
                
                $currency_code = Currency::where('id',$booking->currency_id)->first()->code;

                $parameters = [
                            
                    'merchant_id' => env("INDIPAY_MERCHANT_ID", 8376),

                    //'currency' => $currency_code,
                    'currency' => 'INR',
                    'redirect_url' =>  route('successPayment',[base64_encode($booking->id), $itinerary_id, $payment_method, base64_encode($participant), $booking_status ]),
                    
                    'cancel_url' => route('failedPayment',[base64_encode($booking->id), $itinerary_id, $payment_method, base64_encode($participant), $booking_status  ]),

                    'language' => 'English',

                    'order_id' => $booking->booking_id,
                    
                    'billing_name' => $request->name[0],
                    
                    'billing_address' => $booking->address,
                    
                    'billing_city' => $booking->city,
                    
                    'billing_state' => $booking->state,
                    
                    'billing_zip' => $booking->pin_code,
                    
                    'billing_tel' => $request->mobile[0],
                    
                    'billing_email' => $request->email[0],

                    'amount' => $paid_amount,
                    
                ];
                
                $order = Indipay::prepare($parameters);

                return Indipay::process($order);
            }
        }
    }

    private function storeNewBookings( $request ){

        $schedule = ItinerarySchedule::where('id', $request->booking_date)->first();
      
        $balance_due_date   = '';

        $activity_from_date = '';

        $activity_to_date   = '';

        if($schedule){

            $activity_from_date = $schedule->from_date;

            $activity_to_date   = $schedule->to_date;
           
            $balance_due_date = date('Y-m-d', strtotime('-10 days', strtotime($schedule->from_date)));
            
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

        $booking->age                = json_encode($request->age);

        $booking->address            = $request->address;

        $booking->state              = $request->state;

        $booking->city               = $request->city;

        $booking->pin_code           = $request->pin_code;

        $booking->source             = $request->source;

        $booking->travelexperiance   = $request->travelexperiance;

        $booking->currency_id        = $request->currency_id;

        $booking->activity_price     = $request->activity_price;
        
        $booking->no_of_participants = $request->additional_user + 1; 

        $booking->booking_status     = 'pending';

        $booking->bank_charges       = $this->bank_charges;

        $booking->payment_status     = 'not_paid';

        $booking->activity_from_date = $activity_from_date;

        $booking->activity_to_date   = $activity_to_date;

        $booking->balance_due_date   = $balance_due_date;
        
        if($booking->save()){

            $user = User::getUserWithRole('Admin')->first();
            
            $user->notify(new NewBooking($booking->toArray()));

            return $booking;

        }
        
    } 


    public function paymentSuccess(Request $request, $id, $itinerary_id, $payment_paid, $participant, $booking_status){
       
        $response = Indipay::response($request);
        
        $transections = new Transections();
        
        $transections->user_id    = Auth::user()->id;

        $transections->booking_id = base64_decode($id);

        $transections->order_id   = $response['order_id'];

        $transections->billing_name = $response['billing_name'];

        $transections->billing_address = $response['billing_address'];

        $transections->city = $response['billing_city'];

        $transections->state = $response['billing_state'];

        $transections->zip = $response['billing_zip'];

        $transections->country = $response['billing_country'];

        $transections->telephone = $response['billing_tel'];

        $transections->email = $response['billing_email'];

        $transections->trans_date = $response['trans_date'];

        $transections->tracking_id = $response['tracking_id'];

        $transections->bank_ref_no = $response['bank_ref_no'];

        $transections->order_status = $response['order_status'];

        $transections->payment_mode = $response['payment_mode'];

        $transections->card_name = $response['card_name'];

        $transections->currency = $response['currency'];

        $transections->mer_amount = $response['amount'];

        $transections->save();

        $itinerary       = Itinerary::where('id',  base64_decode($itinerary_id))->first(['id','price','currency_id']);
        
        $converted_price = $itinerary->converted_price;
        
        $actual_currecny = $itinerary->currency_id;
       
        $actual_price    = $itinerary->price;
        
        $booking = Booking::where('id',base64_decode($id))->first();

        if( base64_decode($payment_paid) == 'partial' ){
            $participant        = base64_decode($participant);
            $paid_amount        = ($participant * $converted_price/100) * $this->partial_payment;
            $bank_charges       = ($paid_amount/100)*$this->bank_charges;
            $paid_amount        = $paid_amount + $bank_charges;
            $remaining_amount   = ($participant * $converted_price/100) * $this->remaining_payment; 
            $bank_charges       = ($remaining_amount/100)*$this->bank_charges;
            $remaining_amount   = $remaining_amount + $bank_charges;
            $payment_percentage = $this->partial_payment;
            $payment_method     = base64_encode('partial');
            $booking_status     = base64_encode('partial_completed');
        
        }else if(base64_decode($payment_paid) == 'full_payment'){
            $participant        = base64_decode($participant);
            $paid_amount        = $participant * $converted_price;
            $bank_charges       = ($paid_amount/100) * $this->bank_charges;
            $paid_amount        = $paid_amount + $bank_charges;
            $remaining_amount   = 0; 
            $payment_percentage = 100;
            $payment_method     = base64_encode('full_payment');
            $booking_status     = base64_encode('completed');
        
        }else{
            $participant        = base64_decode($participant);
            $paid_amount        = $booking->payment_paid + $booking->remaining_payment;
            $remaining_amount   = 0; 
            $payment_percentage = 100;
            $payment_method     = base64_encode('full_payment');
            $booking_status     = base64_encode('completed');
        }
        $tracking_booking_id = '';
        $lastBookingId = Booking::orderBy('id', 'desc')->where('tracking_booking_id', '!=', NULL)->first();
        if(!empty($lastBookingId)){
            $tracking_booking_id = $lastBookingId->tracking_booking_id;
        }

        if( !empty($tracking_booking_id) || $tracking_booking_id != null ){
            $this->booking_series = $tracking_booking_id + 1;
        }else{
            $this->booking_series + 1;
        }

        if($response['order_status'] === "Success"){
            
            $booking->booking_status = base64_decode($booking_status);

            $booking->payment_status = base64_decode($payment_paid);
            
            $booking->actual_currency     = $actual_currecny;

            $booking->payment_paid        = $paid_amount;

            $booking->remaining_payment   = $remaining_amount;

            $booking->payment_percentage  = $payment_percentage;
            
            $booking->tracking_booking_id = $this->booking_series;

            $booking->save();

            $response = ['message' => 'Booking process successfully completed.', 'alert-type' => 'success'];
        
        }
        
    	else if($response['order_status'] === "Aborted"){

    		$booking = Booking::where('id',base64_decode($id))->first();
            
            $booking->tracking_booking_id = $this->booking_series;

            $booking->booking_status = 'aborted';
            
            $booking->payment_status = 'aborted';
            
            $booking->save();
            
            $response = ['message' => 'Booking process failed due to aborted payment response.', 'alert-type' => 'danger'];
        
        }
    	else if($response['order_status'] === "Failure")
    	{
            $booking = Booking::where('id',base64_decode($id))->first();
            
            $booking->booking_status = 'failure';
            
            $booking->tracking_booking_id = $this->booking_series;

            $booking->payment_status = 'failure';
            
            $booking->save();
            
            $response = ['message' => 'Booking process failed due to the transaction has been declined.', 'alert-type' => 'danger'];
    
    	}
    	else
    	{
            $booking = Booking::where('id',base64_decode($id))->first();
            
            $booking->booking_status = 'failure';
            
            $booking->tracking_booking_id = $this->booking_series;

            $booking->payment_status = 'failure';
            
            $booking->save();
            
            $response = ['message' => 'Booking process failed Security Error. Illegal access detected.', 'alert-type' => 'danger'];
        }
        
        return redirect()->route('bookingHistory')->with($response);
    }
   
    public function paymentFailed(Request $request){
       echo"<pre>";
       print_r($request->all());
       die;
    }

    public function completePayment(Request $request, $booking_id){
        
        $booking = Booking::with('itinerary','transection','currency','schedule')
        ->where('user_id',Auth::user()->id)
        ->where('tracking_booking_id', $booking_id)
        ->whereNull('deleted_at')
        ->first();

        $participant        = $booking->no_of_participants;
        
        $paid_amount        = $booking->remaining_payment;
        
        $remaining_amount   = 0; 
        
        $payment_percentage = 100;
        
        $payment_method     = base64_encode('remaining_payment');
        
        $booking_status     = base64_encode('completed');
        
        $itinerary_id       = base64_encode($booking->itinerary_id);
        
        $name   = json_decode($booking->name);
        
        $email  = json_decode($booking->email);
        
        $mobile = json_decode($booking->mobile);
        
        $currency_code = Currency::where('id',$booking->currency_id)->first()->code;

        $parameters = [
                    
            'merchant_id' => env("INDIPAY_MERCHANT_ID", 8376),

            //'currency' => $currency_code,
            'currency' => 'INR',
            'redirect_url' =>  route('successPayment',[base64_encode($booking->id), $itinerary_id, $payment_method,base64_encode($participant), $booking_status]),
            
            'cancel_url' => route('failedPayment',[base64_encode($booking->id), $itinerary_id, $booking_status, base64_encode($participant), $payment_method]),

            'language' => 'English',

            'order_id' => $booking->booking_id,
            
            'billing_name' => $name[0],
            
            'billing_address' => $booking->address,
            
            'billing_city' => $booking->city,
            
            'billing_state' => $booking->state,
            
            'billing_zip' => $booking->pin_code,
            
            'billing_tel' => $mobile[0],
            
            'billing_email' => $email[0],

            'amount' => $paid_amount,
            
        ];
        
        $order = Indipay::prepare($parameters);

        return Indipay::process($order);

    }

}
