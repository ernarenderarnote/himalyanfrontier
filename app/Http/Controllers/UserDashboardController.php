<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InqueryRequest;
use Validator;
use App\Inquery;

class UserDashboardController extends Controller
{
   public function index(Request $request){
        return view('');
   }
}
