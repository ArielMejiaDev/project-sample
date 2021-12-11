<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'slug' => $this->resource->slug,
            'title' => $this->resource->title,
            'content' => $this->resource->content,
            'thumbnail' => $this->resource->thumbnail,
            'author' => UserResource::make($this->resource->author),
        ];
    }
}
