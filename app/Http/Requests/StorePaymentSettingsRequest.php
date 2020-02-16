<?php

namespace App\Http\Requests;

use App\PaymentSettings;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentSettingsRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'bank_charges' => [
                'required',
                'numeric'
            ],
            'partial_payment' => [
                'required',
                'numeric'
            ],
            
        ];
    }
}
