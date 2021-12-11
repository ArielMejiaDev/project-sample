<?php

namespace App\Traits;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

trait SoftDeletable
{
    use SoftDeletes;

    public static function bootSoftDeletable()
    {
        static::deleted(function (Article $model) {
            collect($model->softDeletableIdentifiers)->each(function ($softDeletableIdentifier) use (&$model) {

                $model->{$softDeletableIdentifier} = "{$model->{$softDeletableIdentifier}} - deleted";

                $totalWithNameLikeCurrentModel = $model->newQuery()
                    ->onlyTrashed()
                    ->where($softDeletableIdentifier, 'LIKE', "%{$model->{$softDeletableIdentifier}}%")
                    ->count();

                if ($totalWithNameLikeCurrentModel > 0) {
                    $totalWithNameLikeCurrentModel++;
                    $model->{$softDeletableIdentifier} = "{$model->{$softDeletableIdentifier}} {$totalWithNameLikeCurrentModel}";
                }

            });

            $model->save();
        });
    }
}
