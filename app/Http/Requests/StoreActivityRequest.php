<?php

namespace App\Http\Requests;

use App\Activity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreActivityRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('activity_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('activities')->whereNull('deleted_at'),
            ],
        ];
    }
}
