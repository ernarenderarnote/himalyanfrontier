<?php

namespace App\Http\Requests;

use App\Destination;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyDestinationRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('destination_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:destinations,id',
        ];
    }
}
