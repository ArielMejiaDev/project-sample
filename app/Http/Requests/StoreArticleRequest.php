<?php

namespace App\Http\Requests;

class StoreArticleRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'content' => ['required', 'string', 'min:10', 'max:1000'],
            'thumbnail' => ['nullable', 'string', 'min:10', 'max:100'],
        ];
    }
}
