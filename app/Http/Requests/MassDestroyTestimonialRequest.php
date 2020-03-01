<?php

namespace App\Http\Requests;

use App\Testimonials;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyTestimonialRequest extends FormRequest
{
   
    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:testimonials,id',
        ];
    }
}
