<?php

namespace App\Http\Requests;

use App\Itinerary;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyItineraryRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('itinerary_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:itineraries,id',
        ];
    }
}
