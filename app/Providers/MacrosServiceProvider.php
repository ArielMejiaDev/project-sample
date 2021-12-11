<?php

namespace App\Providers;


use App\Macros\Collection\Paginate;
use App\Macros\TestResponse\AssertResource;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestResponse;

class MacrosServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        TestResponse::mixin(new AssertResource);
        Collection::macro('paginate', app(Paginate::class)());
    }
}
