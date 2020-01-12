<?php

namespace App\Http\Requests;

use App\Activity;
use Illuminate\Foundation\Http\FormRequest;

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
            ],
        ];
    }
}
