<?php

namespace App\Observers;

use App\Models\Article;

class ArticleObserver
{
    public function creating(Article $article)
    {
        $article->slug = $article->makeSlug($article->title);
        $article->published_at = $article->makePublishedAt();
    }

    public function updating(Article $article)
    {
        $article->slug = $article->makeSlug($article->title);
        $article->published_at = $article->makePublishedAt();
    }
}
