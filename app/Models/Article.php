<?php

namespace App\Models;

use App\Traits\SoftDeletable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 *
 * @method byAuthor()
 *
 */
class Article extends Model
{
    use HasFactory;
    use SoftDeletable;

    protected $fillable = [
        'slug', 'title', 'content', 'thumbnail', 'author_id'
    ];

    public array $softDeletableIdentifiers = [
        'title'
    ];

    public function makeSlug($value): string
    {
        return Str::slug($value);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower($value);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeInsensitiveTitleSearch(Builder $query, $value): Builder
    {
        return $query->where(function ($query) use ($value) {
            $query->where('title', 'LIKE', '%' . ucfirst($value) . '%')
                ->orWhere('title', 'LIKE', '%' . strtoupper($value) . '%')
                ->orWhere('title', 'LIKE', '%' . strtolower($value) . '%');
        });
    }

    public function scopeByAuthor(Builder $query, $authorId): Builder
    {
        return $query->where('author_id', $authorId);
    }
}
