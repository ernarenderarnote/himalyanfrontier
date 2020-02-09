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
use Auth;

class BookingController extends Controller
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
       /* $validation['schedule_id'] = 'required';
        $validation['name'] ='required';
        $validation['mobile']='required';
        $validation['age'] = 'required';
        $validation['gender'] ='required';
        $validation['email']='required';
        $validation['height'] = 'required';
        $validation['weight'] ='required';
        $validation['state']='required';
        $validation['city'] = 'required';
        $validation['pin_code'] ='required';
        $validation['source']='required';
        $validation['travelexperiance'] = 'required';
        $validation['no_of_participants'] ='required';
        $validation['agree']='required'; 

        $validator = Validator::make($request->all(), $validation);

            if($validator->fails()) {
                $response['error'] = $validator->errors()->all();
                return redirect()->back()->withErrors($response['error']);
            }
            else{*/
$rand_number  = rand(10,100);
            $parameters = [
                
                'merchant_id' => 8376,

                'currency' => 'INR',

                'redirect_url' => 'http://www.newfrontier.himalayanfrontiers.com/payment_success',

                'cancel_url' => 'http://www.newfrontier.himalayanfrontiers.com/payment_failed',

                'language' => 'English',

                'tid' => $rand_number,

                'order_id' => $rand_number,

                'amount' => '1234',
                
            ];
            
            $order = Indipay::prepare($parameters);
            return Indipay::process($order);
        //}
    }
    
        

}
