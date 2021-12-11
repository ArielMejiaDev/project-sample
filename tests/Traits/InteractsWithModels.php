<?php

namespace Tests\Traits;

use Illuminate\Database\Eloquent\Model;

trait InteractsWithModels
{
    /**
     * Assert that a given models exactly matches fillable properties.
     *
     * @param  Model  $expectedModel usually a model in memory
     * @param  Model  $actualModel usually a model that persists
     * @return $this
     */
    protected function assertModelEquals(Model $expectedModel, Model $actualModel)
    {
        $actualModel->refresh();

        $companyModelFields = collect(array_flip($actualModel->getFillable()));

        $companyModelFields->each(
            fn ($field) => $this->assertEquals($expectedModel->{$field}, $actualModel->{$field})
        );

        return $this;
    }
}
