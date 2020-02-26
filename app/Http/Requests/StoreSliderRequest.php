<?php

namespace App\Http\Requests;

use App\Slider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSliderRequest extends FormRequest
{
   
    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('sliders')->whereNull('deleted_at'),
            ],
            'photo' => [
                'required'
            ],
            'photo.*' => [
                'required',
                'image'
            ]
        ];
    }

    public function messages() {
        return [
            'title.required'        => 'Title is required.',
            'title.unique'          => 'Title has already been taken.',
            'photo.required'        => 'Slider Images are required.',
            'photo.image'           => 'Slider Images must be an Image.',
            'photo.*required'        => 'Slider Images are required.',
            'photo.*image'           => 'Slider Images must be an Image.',
        ];
    }
}