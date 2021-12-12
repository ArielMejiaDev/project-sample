<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $users = User::query()->get();

        Article::factory()->for($users->first(), 'author')->published()->create([
            'title' => 'Advance PHP tips.'
        ]);

        Article::factory()->for($users->first(), 'author')->published()->create([
            'title' => 'Advance Laravel tips.'
        ]);

        Article::factory()->for($users->first(), 'author')->published()->create([
            'title' => 'Advance Javascript tips.'
        ]);

        Article::factory()->for($users->first(), 'author')->published()->create([
            'title' => 'Advance VueJS tips.'
        ]);

        Article::factory()->for($users->first(), 'author')->published()->create([
            'title' => 'Advance Inertia tips.'
        ]);

        $users->each(function (User $user) {
            Article::factory()->for($user, 'author')->published()->create();
        });

        Article::factory()->largeText()->published()->create([
            'title' => 'long article'
        ]);

        Article::factory()->unpublished()->count(10)->createQuietly();

        Article::factory()->trashed()->count(10)->create();
    }
}
