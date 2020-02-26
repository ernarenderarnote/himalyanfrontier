<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsConditions extends Controller
{
    public function index(){
        return view('termsAndConditions');
    }
}
