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
                Rule::unique('currencies'),
            ],
            'code' => [
                'required',
                Rule::unique('currencies'),
            ],
            'symbol' => [
                'required',
                Rule::unique('currencies'),
            ],
            'exchange_rate' => [
                'required',
            ],
        ];
    }
}
