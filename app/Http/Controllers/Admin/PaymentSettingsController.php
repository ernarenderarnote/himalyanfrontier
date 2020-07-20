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
        $additional_fields = array();
        for($i=0;$i<count($request->field_name);$i++){
            if($request->field_name[$i] !='' && $request->field_value[$i] != ''){
                $additional_fields[] = array('field_name'=>$request->field_name[$i],
                'field_value'=> $request->field_value[$i]
                ); 
            }    
        }
        if(count($additional_fields) > 0){
            $paymentSettings->additional_fields = json_encode($additional_fields);
        }else{
            $paymentSettings->additional_fields = '';
        }
       

        if($paymentSettings->save()){
            $response = ['message' => 'Settings Saved.', 'alert-type' => 'success'];
        }
        
        return redirect()->route('admin.paymentSettings')->with($response);
    
    }
}