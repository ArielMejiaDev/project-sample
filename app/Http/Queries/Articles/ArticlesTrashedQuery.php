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


//namespace App\Http\Queries\Articles;
//
//use App\Models\Article;
//use Spatie\QueryBuilder\QueryBuilder;
//
//class ArticlesTrashedQuery extends QueryBuilder
//{
//    public function __construct()
//    {
//        parent::__construct(Article::query());
//
//        $this->newQuery()->onlyTrashed()->with('author');
//    }
//}
