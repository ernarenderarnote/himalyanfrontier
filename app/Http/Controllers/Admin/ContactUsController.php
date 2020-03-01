<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ContactUsReply;
use Notification;
use App\ContactUs;
use App\User;
use Auth;

class ContactUsController extends Controller
{
    public function index(){

        $contacts = ContactUs::all();
        return view('admin.contactUs.index',compact('contacts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contact_us)
    {
        return view('admin.contactUs.show', compact('contact_us'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUs $contact_us)
    {
        $input = $request->all();
        
        $input['status'] = 'checked';

        $contact_us->status = $input['status'];
        
        if(  $contact_us->save() ){

            $input['subject']      = 'Inquery Reply.';
       
            $input['to_email']     = $contact_us->email;
            
            $input['greeting']     = 'Hello '.$contact_us->name;
        
            $input['body']         = $request->reply_message;
            
            $input['thanks']       = 'Thanks for inquery with Himalayan Frontiers.'; 

            $email = $contact_us->email;

            Notification::route('mail', $email)->notify(new ContactUsReply($input));
            
            $response = ['message' => 'Reply Sended Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.contact-us.index')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contact_us)
    {

        if( $contact_us->delete() ){
            $response = ['message' => 'Deleted Successfully.', 'alert-type' => 'success'];
        }
        return back()->with($response);
    }

    public function massDestroy(Request $request)
    {
        
        Inquery::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
