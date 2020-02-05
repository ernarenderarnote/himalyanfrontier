<?php

namespace App\Http\Requests;

use App\Inquery;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InqueryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'phone' => [
                'required',
                'numeric'
            ],
            'email' => [
                'required',
                'email'
            ],
            'subject' => [
                'required',
            ],
            'message' => [
                'required',
            ],
        ];
    }
}
