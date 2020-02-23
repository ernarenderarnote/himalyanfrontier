<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InqueryRequest;
use App\Notifications\NewInquery;
use Validator;
use App\Inquery;
use App\User;

class InqueryController extends Controller
{
   public function store(InqueryRequest $request){

    $input = $request->all();
        
    $activity = new Inquery();

    if( Inquery::create($input) ){
        $user = User::where('email','narender2709@gmail.com')->first();
            
        $user->notify(new NewInquery($input));
        $response = ['message' => 'Inquery Sumbitted successfully.', 'alert-type' => 'success'];
    }
    return redirect()->back()->with($response);
   }
}
