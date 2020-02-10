<?php

namespace App\Http\Requests;

use App\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('currency_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('currencies')->whereNull('deleted_at'),
            ],
            'code' => [
                'required',
                Rule::unique('currencies')->whereNull('deleted_at'),
            ],
            'symbol' => [
                'required',
                Rule::unique('currencies')->whereNull('deleted_at'),
            ],
            'exchange_rate' => [
                'required',
            ],
        ];
    }
}
