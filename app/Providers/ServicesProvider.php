<?php

namespace App\Providers;

use App\Http\Controllers\API\ArticleSearchController;
use App\Http\Queries\ArticleQuery;
use Illuminate\Support\ServiceProvider;
use Spatie\QueryBuilder\QueryBuilder;

class ServicesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->when(ArticleSearchController::class)
            ->needs(QueryBuilder::class)
            ->give(ArticleQuery::class);
    }
}
