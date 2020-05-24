<?php

namespace App\Http\Requests;

use App\Slider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSliderRequest extends FormRequest
{

    public function rules()
    {
       
        return [
            'title' => [
                'required',
                Rule::unique('sliders')->ignore($this->slide)->whereNull('deleted_at'),
            ],
			'photo' => [
                'required_without:gallery_upload_img,null',
            ],
            'photo.*' => [
				'required_without:gallery_upload_img.*,null',
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
            'photo.*required'       => 'Slider Images are required.',
            'photo.*image'          => 'Slider Images must be an Image.',
        ];
    }
}