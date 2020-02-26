<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
    public function index(){
        return view('paymentMethods');
    }
}
