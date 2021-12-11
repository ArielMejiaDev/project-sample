<?php

namespace App\Providers;


use App\Macros\Collection\Paginate;
use App\Macros\TestResponse\AssertResource;
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
        TestResponse::macro('assertResource', app(AssertResource::class)());
        Collection::macro('paginate', app(Paginate::class)());
    }
}
