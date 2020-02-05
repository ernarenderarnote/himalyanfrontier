<?php

namespace App\Http\Requests;

use App\Blog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('blog_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                Rule::unique('blogs')->ignore($this->blog),
            ],
        ];
    }
}
