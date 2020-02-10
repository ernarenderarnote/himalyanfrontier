<?php

namespace App\Http\Requests;

use App\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('blog_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('blogs')->whereNull('deleted_at'),
            ],
        ];
    }
}
