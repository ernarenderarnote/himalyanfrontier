<?php

namespace App\Http\Requests;

use App\Activity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                Rule::unique('activities')->ignore($this->activity)->whereNull('deleted_at'),
            ],
        ];
    }
}
