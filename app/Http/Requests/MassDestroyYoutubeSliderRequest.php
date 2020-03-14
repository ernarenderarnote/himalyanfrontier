<?php

namespace App\Http\Requests;
use App\YoutubeSlider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyYoutubeSliderRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:youtube_sliders,id',
        ];
    }
}
