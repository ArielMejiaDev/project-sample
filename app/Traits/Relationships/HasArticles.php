<?php

namespace App\Traits\Relationships;

use App\Models\Article;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasArticles
{
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }
}
