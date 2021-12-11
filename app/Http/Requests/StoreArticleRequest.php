<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

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

    protected function passedValidation()
    {
        if ($this->input('published')) {
            $this->merge(['published_at' => now()]);
        }
    }

    public function validated(): array
    {
        if ($this->input('published')) {
            return array_merge(parent::validated(), ['published_at' => $this->input('published_at')]);
        }
        return parent::validated();
    }
}
