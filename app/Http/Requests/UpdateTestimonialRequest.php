<?php

namespace App\Http\Requests;

use App\Testimonial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTestimonialRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('testimonials')->ignore($this->testimonial),
            ],
            'author' => [
                'required',
            ],
        ];
    }
}
