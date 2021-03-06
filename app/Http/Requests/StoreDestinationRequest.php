<?php

namespace App\Http\Requests;

use App\Destination;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                Rule::unique('destinations')->whereNull('deleted_at'),
            ],
        ];
    }
}
