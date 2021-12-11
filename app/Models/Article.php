<?php

namespace App\Models;

use App\Builders\ArticleBuilder;
use App\Traits\Relationships\BelongsToAnAuthor;
use App\Traits\SoftDeletable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Class Article
 *
 * @property $id
 * @property $slug
 * @property $title
 * @property $content
 * @property $thumbnail
 * @property $author_id
 * @property Carbon $published_at
 *
 * @method byAuthor()
 *
 */
class Article extends Model
{
    use BelongsToAnAuthor, HasFactory, SoftDeletable;

    public function newEloquentBuilder($query): Builder
    {
        return new ArticleBuilder($query);
    }

    protected $fillable = [
        'slug', 'title', 'content', 'thumbnail', 'author_id', 'published_at'
    ];

    protected $dates = [
        'published_at',
    ];

    public array $softDeletableIdentifiers = [
        'title'
    ];

    public function getPublishedAtForHumansAttribute($key)
    {
        if ($this->published_at) {
            return $this->attributes['published_at_for_humans'] = $this->published_at->diffForHumans();
        }
    }

    public function makeSlug($value): string
    {
        return Str::slug($value);
    }

    public function makePublishedAt(): ?Carbon
    {
        $publishedAt = null;

        if (request()->input('published')) {
            $publishedAt = now();
        }

        return $publishedAt;
    }
}
