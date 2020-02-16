<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\StorePaymentSettingsRequest;
use App\Http\Controllers\Controller;
use Auth;
use App\PaymentSettings;

class PaymentSettingsController extends Controller
{
    public function index(Request $request){
      
        $paymentSettings     = PaymentSettings::first();
        
        return view('admin.paymentSettings.index',compact('paymentSettings'));
    }
    
    public function store(StorePaymentSettingsRequest $request){
      
        $paymentSettings     = PaymentSettings::first();
        
        if( !is_null( $paymentSettings ) ){
            $paymentSettings = $paymentSettings;
        }else{
            $paymentSettings = new PaymentSettings();
        }

        $paymentSettings->bank_charges = $request->bank_charges;
        
        $paymentSettings->partial_payment = $request->partial_payment;

        if($paymentSettings->save()){
            $response = ['message' => 'Settings Saved.', 'alert-type' => 'success'];
        }
        
        return redirect()->route('admin.paymentSettings')->with($response);
    
    }
}