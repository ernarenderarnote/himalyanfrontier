<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
{
    
    public function rules()
    {
       
        return [
            'first_name' => [
                'required',
            ],
            'last_name' => [
                'required',
            ],
            'country_id' => [
                'required',
            ],
            'state' => [
                'required',
            ],
            'city' => [
                'required',
            ],
            'email_address' => [
                'required',
                'email',
            ],
            'zip_code' => [
                'required',
                'numeric'
            ],
            'phone_number' => [
                'required',
                'numeric',
            ],
            'currency' => [
                'required',
            ],
            'amount' => [
                'required',
                'numeric',
            ],
            'address' => [
                'required',
            ]
            
        ];
    }

    public function messages()
    {
       
        return [
            'first_name.required' => 'First Name is required.',
            'last_name.required'  => 'Last Name is required.',
            'country.required'    => 'Country is required.',
            'state.required'      => 'State is required.',
            'city.required'       => 'City is required.',
            'last_name.required'  => 'Last Name is required.',

        ];
    }
}
