<?php

namespace App\Http\Requests;

use App\Currency;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('currency_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:currencies,id',
        ];
    }
}
