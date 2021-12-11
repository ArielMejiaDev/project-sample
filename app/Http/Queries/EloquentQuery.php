<?php

namespace App\Http\Queries;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class EloquentQuery
 *
 * @method all()
 * @method get()
 * @method paginate()
 * @method simplePaginate()
 * @method cursor()
 */
abstract class EloquentQuery
{
    /** @var Builder */
    protected $query;

    public function __call($name, $arguments)
    {
        return $this->query->{$name}();
    }
}
