<?php

namespace App\Http\Requests;

use App\Activity;
use Illuminate\Foundation\Http\FormRequest;

class UpdateActivityRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('activity_edit');
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
