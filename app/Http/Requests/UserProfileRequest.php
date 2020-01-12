<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use User;
use Auth;

class UserProfileRequest extends FormRequest
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
            'email' => [
                'required',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
             'phone' => [
                'required',
                'numeric',
            ],
            'age' => [
                'required',
                'numeric',
            ],
            'gender' => [
                'required',
            ],
            'height' => [
                'required',
                'numeric',
            ],
            'weight' => [
                'required',
                'numeric',
            ],
            'address' => [
                'required',
            ],
        ];
    }
}
