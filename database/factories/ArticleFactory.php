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

    /** Indicate that the model's publish_at column is null.*/
    public function unpublished(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published' => false,
            ];
        });
    }

    /** Indicate that the model's publish_at column has a timestamp value.*/
    public function published(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published' => true,
            ];
        });
    }
}
