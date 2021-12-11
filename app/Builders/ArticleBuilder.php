<?php

declare(strict_types=1);

namespace App\Builders;

use App\Models\User;
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

    public function byAuthor(User $author): self
    {
        return $this->where('author_id', $author->id);
    }

    public function published(): self
    {
        return $this->whereNotNull('published_at');
    }
}
