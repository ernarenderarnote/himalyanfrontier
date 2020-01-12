<?php

namespace App\Http\Requests;

use App\Itinerary;
use Illuminate\Foundation\Http\FormRequest;

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
            ],
            
        ];
    }
}
