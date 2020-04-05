<?php

namespace App\Http\Requests;

use App\Testimonial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTestimonialRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('testimonials')->whereNull('deleted_at'),
            ],
            'author' => [
                'required',
            ],
        ];
    }
}
