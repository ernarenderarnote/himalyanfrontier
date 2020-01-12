<?php

namespace App\Http\Requests;

use App\Destination;
use Illuminate\Foundation\Http\FormRequest;

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
            ],
        ];
    }
}
