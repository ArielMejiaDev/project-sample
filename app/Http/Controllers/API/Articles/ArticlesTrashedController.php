<?php

namespace App\Http\Controllers\API\Articles;

use App\Http\Controllers\Controller;
use App\Http\Queries\EloquentQuery;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as ArticleResourceCollection;

class ArticlesTrashedController extends Controller
{
    protected EloquentQuery $articles;

    public function __construct(EloquentQuery $articles)
    {
        $this->articles = $articles;
    }

    public function __invoke(): ArticleResourceCollection
    {
        return ArticleResource::collection($this->articles->paginate());
    }
}
