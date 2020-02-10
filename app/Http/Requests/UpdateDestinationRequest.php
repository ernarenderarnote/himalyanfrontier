<?php

namespace App\Http\Requests;

use App\Destination;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDestinationRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('destination_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('destinations')->ignore($this->destination)->whereNull('deleted_at'),
            ],
        ];
    }
}
