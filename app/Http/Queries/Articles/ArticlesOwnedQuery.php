<?php

namespace App\Http\Queries\Articles;

use App\Http\Queries\EloquentQuery;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesOwnedQuery extends EloquentQuery
{
    public function __construct(Request $request)
    {
        return $this->query = Article::query()
            ->byAuthor(optional(request()->user('sanctum'))->id)
            ->withTrashed();
    }
}
