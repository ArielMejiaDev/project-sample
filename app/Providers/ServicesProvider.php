<?php

namespace App\Providers;

use App\Http\Controllers\API\Articles\ArticlesController;
use App\Http\Controllers\API\Articles\ArticlesOwnedController;
use App\Http\Controllers\API\Articles\ArticlesSearchController;
use App\Http\Controllers\API\Articles\ArticlesTrashedController;
use App\Http\Queries\Articles\ArticlesOwnedQuery;
use App\Http\Queries\Articles\ArticlesQuery;
use App\Http\Queries\Articles\ArticlesSearchQuery;
use App\Http\Queries\Articles\ArticlesTrashedQuery;
use App\Http\Queries\EloquentQuery;
use App\Services\Contracts\IpHandlerContract;
use App\Services\Contracts\ReadingMinutesCalculatorContract;
use App\Services\GeoIp\IpHandler;
use App\Strategies\ReadingMinutesCalculatorHandler;
use Illuminate\Support\ServiceProvider;
use Spatie\QueryBuilder\QueryBuilder;

class ServicesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->when(ArticlesController::class)
            ->needs(QueryBuilder::class)
            ->give(ArticlesQuery::class);

        $this->app->when(ArticlesSearchController::class)
            ->needs(QueryBuilder::class)
            ->give(ArticlesSearchQuery::class);

        $this->app->when(ArticlesTrashedController::class)
            ->needs(EloquentQuery::class)
            ->give(ArticlesTrashedQuery::class);

        $this->app->when(ArticlesOwnedController::class)
            ->needs(EloquentQuery::class)
            ->give(ArticlesOwnedQuery::class);

        $this->app->when(ReadingMinutesCalculatorHandler::class)
            ->needs(IpHandlerContract::class)
            ->give(IpHandler::class);

        $this->app->when(ArticlesController::class)
            ->needs(ReadingMinutesCalculatorContract::class)
            ->give(app(ReadingMinutesCalculatorHandler::class)());
    }
}
