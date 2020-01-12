<?php

namespace App\Http\Requests;

use App\Itinerary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItineraryRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('itinerary_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('itineraries')->ignore($this->itinerary),
            ],
        ];
    }
}
