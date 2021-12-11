<?php

namespace App\Providers;

use App\Http\Controllers\API\ArticleSearchController;
use App\Http\Queries\ArticleQuery;
use App\Models\Article;
use App\Observers\ArticleObserver;
use Illuminate\Support\ServiceProvider;
use Spatie\QueryBuilder\QueryBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Article::observe(ArticleObserver::class);
    }
}
