<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{

    public function rules()
    {
        return [
            'mobile_number' => 'required|numeric',
        ];
    }
}
