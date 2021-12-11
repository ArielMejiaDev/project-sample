<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Queries\ArticleQuery;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as ArticleResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class ArticleSearchController extends Controller
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
