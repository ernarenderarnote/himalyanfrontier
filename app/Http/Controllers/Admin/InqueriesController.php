<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\InqueryReply;
use Notification;
use App\Inquery;
use App\User;
use Auth;

class InqueriesController extends Controller
{
    public function index(){

        $inqueries = Inquery::with('itinerary')->get();
        return view('admin.inqueries.index',compact('inqueries'));
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
    public function show(Request $request, $id)
    {
        $inquery = Inquery::with('itinerary')->where('id',$id)->first();
        return view('admin.inqueries.show', compact('inquery'));
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
    public function update(Request $request, Inquery $inquery)
    {
        $input = $request->all();
        
        $input['status'] = 'checked';

        $inquery->status = $input['status'];
        
        if(  $inquery->save() ){

            $input['subject']      = 'Inquery Reply.';
       
            $input['to_email']     = $inquery->email;
            
            $input['greeting']     = 'Hello '.$inquery->name;
        
            $input['body']         = $request->reply_message;
            
            $input['thanks']       = 'Thanks for inquery with Himalayan Frontiers.'; 

            $email = $inquery->email;

            Notification::route('mail', $email)->notify(new InqueryReply($input));
            
            $response = ['message' => 'Reply Sended Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.inqueries.index')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquery $inquery)
    {

        if( $inquery->delete() ){
            $response = ['message' => 'Inquery Deleted Successfully.', 'alert-type' => 'success'];
        }
        return back()->with($response);
    }

    public function massDestroy(Request $request)
    {
        
        Inquery::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

    public function display(Request $request,$id,$notification_id){
        
        $inquery = Inquery::with('itinerary')->where('id',$id)->first();
        
        $notification = $request->user()->notifications()->where('id', $notification_id)->first();
        
        if($notification) {
            $notification->markAsRead();
        }

        return view('admin.inqueries.show', compact('inquery'));
    }
}
