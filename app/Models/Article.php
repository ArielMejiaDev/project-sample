<?php

namespace App\Models;

use App\Builders\ArticleBuilder;
use App\Traits\Relationships\BelongsToAnAuthor;
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
    use BelongsToAnAuthor;
    use HasFactory;
    use SoftDeletable;

    public function newEloquentBuilder($query): Builder
    {
        return new ArticleBuilder($query);
    }

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
}
