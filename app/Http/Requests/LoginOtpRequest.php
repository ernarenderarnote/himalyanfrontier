<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginOtpRequest extends FormRequest
{

    public function rules()
    {
       
        return [
            'otp' => 'required',
        ];
    }
}
