<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InqueryRequest;
use Validator;
use App\Inquery;

class InqueryController extends Controller
{
   public function store(InqueryRequest $request){

    $input = $request->all();
        
    $activity = new Inquery();

    if( Inquery::create($input) ){
        $response = ['message' => 'Inquery Sumbitted successfully.', 'alert-type' => 'success'];
    }
    return redirect()->back()->with($response);
   }
}
