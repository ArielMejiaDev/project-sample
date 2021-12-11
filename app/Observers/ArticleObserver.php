<?php

namespace App\Observers;

use App\Models\Article;

class ArticleObserver
{
    public function creating(Article $article)
    {
        $article->slug = $article->makeSlug($article->title);
    }

    public function updating(Article $article)
    {
        $article->slug = $article->makeSlug($article->title);
    }

    public function deleted(Article $article)
    {
        //
    }

    public function restored(Article $article)
    {
        //
    }

    public function forceDeleted(Article $article)
    {
        //
    }
}
