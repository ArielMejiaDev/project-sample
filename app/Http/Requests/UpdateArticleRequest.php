<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $titleUniqueRule = Rule::unique(Article::class)
            ->ignore($this->route()->article->id);

        return [
            'title' => ['required', 'string', 'min:5', 'max:100', $titleUniqueRule],
            'content' => ['required', 'string', 'min:10', 'max:1000'],
            'thumbnail' => ['nullable', 'string', 'min:10', 'max:100'],
            'published' => ['nullable', 'boolean'],
        ];
    }

    protected function passedValidation()
    {
        $this->route()->article->touch();
    }
}
