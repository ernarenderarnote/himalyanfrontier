<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
{
    
    public function rules()
    {
       
        return [
            'customer_name' => [
                'required',
            ],
            'email'=> [
                'required',
            ],
            'booking_handled_by' => [
                'required',
            ],
            'contact_number'=> [
                'required',
            ],
            'tax_details'=> [
                'required',
            ],
            'invoice_due_date'=> [
                'required',
            ],
            'travel_date'=> [
                'required',
            ],
            'travel_location'=> [
                'required',
            ],
            'currency'=> [
                'required',
            ],
            'no_of_persons'=> [
                'required',
            ],
            'per_person_price'=> [
                'required',
            ],
            'tax'=> [
                'required',
            ],
        ];
    }

    
}
