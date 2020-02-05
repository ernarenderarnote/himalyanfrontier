<?php

namespace App\Http\Requests;

use App\Currency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('currency_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('currencies')->ignore($this->currency),
            ],
            'code' => [
                'required',
                Rule::unique('currencies')->ignore($this->currency),
            ],
            'symbol' => [
                'required',
                Rule::unique('currencies')->ignore($this->currency),
            ],
            'exchange_rate' => [
                'required',
            ],
        ];
    }
}
