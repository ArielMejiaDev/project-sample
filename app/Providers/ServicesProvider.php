<?php

namespace App\Providers;

use App\Http\Controllers\API\Articles\ArticlesSearchController;
use App\Http\Controllers\API\Articles\ArticlesTrashedController;
use App\Http\Queries\Articles\ArticlesQuery;
use App\Http\Queries\Articles\ArticlesTrashedQuery;
use App\Http\Queries\EloquentQuery;
use Illuminate\Support\ServiceProvider;
use Spatie\QueryBuilder\QueryBuilder;

class ServicesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->when(ArticlesSearchController::class)
            ->needs(QueryBuilder::class)
            ->give(ArticlesQuery::class);

        $this->app->when(ArticlesTrashedController::class)
            ->needs(EloquentQuery::class)
            ->give(ArticlesTrashedQuery::class);

    }
}
