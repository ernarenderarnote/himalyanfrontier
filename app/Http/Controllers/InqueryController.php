<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InqueryRequest;
use App\Notifications\NewInquery;
use Validator;
use App\Inquery;
use App\Itinerary;
use App\User;

class InqueryController extends Controller
{
   public function store(InqueryRequest $request){

    $input = $request->all();
        
    $itinerary = Itinerary::where('id',$request->itinerary_id)->first()->title;
    $input = Inquery::create($input);
    if( $input ){
        $input['activity_name'] = $itinerary;
        $user = User::getUserWithRole('Admin')
                ->first();
        $user->notify(new NewInquery($input));
        $response = ['message' => 'Thank you for submitting a query.', 'alert-type' => 'success'];
    }
    return redirect()->back()->with($response);
   }

   public function priceRequest(Request $request){
        $input = $request->all();
            
        $itinerary = Itinerary::where('id',$request->itinerary_id)->first()->title;
        $input = Inquery::create($input);
        if( $input ){
            $input['activity_name'] = $itinerary;
            $user = User::getUserWithRole('Admin')
                    ->first();
            $user->notify(new NewInquery($input));
            $response = ['status' => 'success', 'message' => 'Thanks for price request. We will contact you shortly.'];
        }
        return response($response);
   }
}
