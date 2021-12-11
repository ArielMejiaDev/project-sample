<?php

namespace App\Http\Controllers\API\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as ArticleResourceCollection;
use Illuminate\Http\Response;

class ArticlesController extends Controller
{
    protected Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;

        $this->authorizeResource(Article::class, 'article', [
            'except' => [ 'index', 'show' ]
        ]);
    }

    public function index(): ArticleResourceCollection
    {
        $articles = $this->article->newQuery()->with('author')->paginate()->appends('published_at_for_humans');
        return ArticleResource::collection($articles);
    }

    public function store(StoreArticleRequest $request): ArticleResource
    {
        $article = $request->user()
            ->articles()
            ->create($request->validated());

        return ArticleResource::make($article);
    }

    public function show(Article $article): ArticleResource
    {
        $article->append('published_at_for_humans')->load('author');
        return ArticleResource::make($article);
    }

    public function update(UpdateArticleRequest $request, Article $article): ArticleResource
    {
        $article->update($request->validated());
        $article->append('published_at_for_humans')->load('author');
        return ArticleResource::make($article);
    }

    public function destroy(Article $article): Response
    {
        $article->delete();
        return response()->noContent();
    }
}
