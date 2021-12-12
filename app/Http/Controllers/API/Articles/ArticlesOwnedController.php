<?php

namespace App\Http\Controllers\API\Articles;

use App\Http\Controllers\Controller;
use App\Http\Queries\Articles\ArticlesOwnedQuery;
use App\Http\Queries\EloquentQuery;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as ArticleResourceCollection;

class ArticlesOwnedController extends Controller
{
    protected EloquentQuery $articles;

    public function __construct(EloquentQuery $articles)
    {
        $this->articles = $articles;
    }

    public function __invoke(Request $request): ArticleResourceCollection
    {
        return ArticleResource::collection($this->articles->paginate());
    }
}
