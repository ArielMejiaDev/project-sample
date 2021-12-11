<?php

namespace App\Macros\TestResponse;

use Closure;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Testing\TestResponse;

/**
 * Assert that the json response match exactly with a given resource.
 *
 * @param JsonResource
 * @return TestResponse
 * @instantiated
 *
 */
class AssertResource
{
    public function assertResource(): Closure
    {
        return function (JsonResource $resource) {
            /** @var \Illuminate\Testing\TestResponse $this */

            if ($resource->resource instanceof AbstractPaginator) {
                return $this->decodeResponseJson()
                    ->assertSubset([
                        'data' => json_decode($resource->toJson(), 1)
                    ]);
            }

            $resource = ['data' => json_decode($resource->toJson(), 1)];
            return $this->assertExactJson($resource);
        };
    }
}
