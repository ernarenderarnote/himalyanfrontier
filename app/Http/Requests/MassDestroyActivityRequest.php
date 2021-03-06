<?php

namespace App\Http\Requests;

use App\Activity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyActivityRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('activity_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:activities,id',
        ];
    }
}
