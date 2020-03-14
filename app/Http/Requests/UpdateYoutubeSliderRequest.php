<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\YoutubeSlider;

class UpdateYoutubeSliderRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('youtube_sliders')->ignore($this->youtube_slider)->whereNull('deleted_at'),
            ],
            'thumbnail_url' => [
                'required',
            ],
            'youtube_url' => [
                'required',
            ],
        ];
    }
}
