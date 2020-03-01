<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactUsRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'     => [
                'required',
            ],
            'email'    => [
                'required',
                'email'
            ],
            'subject'    => [
                'required',
            ],
            'message'    => [
                'required',
            ],
        ];
    }
}
