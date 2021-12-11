<?php

namespace App\Http\Queries\Articles;

use App\Http\Queries\EloquentQuery;
use App\Models\Article;

class ArticlesTrashedQuery extends EloquentQuery
{
    public function __construct()
    {
        return $this->query = Article::query()->onlyTrashed();
    }
}
