<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactUsRequest;
use App\Notifications\ContactUsNotification;
use Notification;
use App\ContactUs;
use App\User;

class ContactUsController extends Controller
{
    public function index(){
        return view('contactUs');
    }

    public function store(StoreContactUsRequest $request){
        $input = $request->all();
        $input = ContactUs::create($input);
        if( $input ){
            
            $user = User::getUserWithRole('Admin')
                ->first();
            Notification::send($user, new ContactUsNotification($input));
            $response = ['message' => 'Thank you for contacting with Himalayan Frontiers.', 'alert-type' => 'success'];
        }
        return redirect()->route('ContactUs')->with($response);
    }
}
