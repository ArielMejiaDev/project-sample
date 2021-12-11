<?php

namespace App\Http\Controllers\API\Articles;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as ArticleResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class ArticlesSearchController extends Controller
{
    protected QueryBuilder $articlesQuery;

    public function __construct(QueryBuilder $articlesQuery)
    {
        $this->articlesQuery = $articlesQuery;
    }

    public function __invoke(): ArticleResourceCollection
    {
        return ArticleResource::collection($this->articlesQuery->paginate());
    }
}
