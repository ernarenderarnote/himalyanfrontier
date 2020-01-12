<?php

namespace App\Http\Requests;

use App\Activity;
use Illuminate\Foundation\Http\FormRequest;

class StoreDestinationRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('destination_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
            ],
        ];
    }
}
