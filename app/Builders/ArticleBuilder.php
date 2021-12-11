<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class ArticleBuilder extends Builder
{
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower($value);
    }

    public function insensitiveTitleSearch($value): self
    {
        return $this->where(function ($query) use ($value) {
            $this->where('title', 'LIKE', '%' . ucfirst($value) . '%')
                ->orWhere('title', 'LIKE', '%' . strtoupper($value) . '%')
                ->orWhere('title', 'LIKE', '%' . strtolower($value) . '%');
        });
    }

    public function byAuthor($authorId): self
    {
        return $this->where('author_id', $authorId);
    }

    public function published(): self
    {
        return $this->whereNotNull('published_at');
    }
}
