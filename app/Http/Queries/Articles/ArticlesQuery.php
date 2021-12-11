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

        $this->allowedSorts('created_at')
            ->allowedFilters([
                AllowedFilter::scope(
                    'title',
                    'insensitiveTitleSearch'
                )
            ])
            ->with('author');
    }
}



