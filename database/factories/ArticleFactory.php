<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->realText(50),
            'slug' => Str::slug($title),
            'content' => $this->faker->realText,
            'thumbnail' => $this->faker->imageUrl,
            'author_id' => User::factory(),
            'published_at' => now(),
        ];
    }

    /** Indicate that the model's publish_at column has a timestamp.*/
    public function published(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => now(),
            ];
        });
    }

    /** Indicate that the model's publish_at column is null.*/
    public function unpublished(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => null,
            ];
        });
    }

    /** Indicate that the model's publish boolean flag is false check the Article Observer.*/
    public function unpublishedFlag(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published' => false,
            ];
        });
    }

    /** Indicate that the model's publish boolean flag is true check the Article Observer.*/
    public function publishedFlag(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published' => true,
            ];
        });
    }

    /** Indicate that the model's content has a very large text.*/
    public function largeText(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'content' => implode($this->faker->words(300), ','),
            ];
        });
    }

    /** Indicate that the model's deleted_at column has a timestamp.*/
    public function trashed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'deleted_at' => now(),
            ];
        });
    }
}
