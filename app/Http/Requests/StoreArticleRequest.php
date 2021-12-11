<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100', Rule::unique(Article::class)],
            'content' => ['required', 'string', 'min:10', 'max:1000'],
            'thumbnail' => ['nullable', 'string', 'min:10', 'max:100'],
            'published' => ['nullable', 'boolean'],
        ];
    }
}
