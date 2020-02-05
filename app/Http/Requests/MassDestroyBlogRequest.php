<?php

namespace App\Http\Requests;

use App\Blog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyBlogRequest extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('blog_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:destinations,id',
        ];
    }
}
