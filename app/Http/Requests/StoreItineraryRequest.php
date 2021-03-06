<?php

namespace App\Http\Requests;

use App\Itinerary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreItineraryRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('itinerary_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('itineraries')->whereNull('deleted_at'),
            ],
            
        ];
    }
}
