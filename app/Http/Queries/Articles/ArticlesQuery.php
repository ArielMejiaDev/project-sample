<?php

namespace App\Http\Queries\Articles;

use App\Models\Article;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ArticlesQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Article::query());

        $this->allowedFilters([
            AllowedFilter::scope('trashed'),
            AllowedFilter::scope('published'),
            AllowedFilter::scope('unpublished'),
        ])
            ->with('author');
    }
}



