<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Article $article */
        $article = $this->resource;

        $result = [
            'id' => $article->id,
            'slug' => $article->slug,
            'title' => $article->title,
            'content' => $article->content,
            'thumbnail' => $article->thumbnail,
            'author' => UserResource::make($article->author),
            'published_at' => $article->published_at,
            'published_at_for_humans' => $article->published_at_for_humans,
        ];

        if (isset($article->reading_minutes)) {
            $result['reading_minutes'] = $article->reading_minutes;
        }

        return $result;
    }
}
