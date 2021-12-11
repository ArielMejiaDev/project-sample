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

        Article::factory()->for($users->first(), 'author')->create([
            'title' => 'Advance PHP tips.'
        ]);

        Article::factory()->for($users->first(), 'author')->create([
            'title' => 'Advance Laravel tips.'
        ]);

        Article::factory()->for($users->first(), 'author')->create([
            'title' => 'Advance Javascript tips.'
        ]);

        Article::factory()->for($users->first(), 'author')->create([
            'title' => 'Advance VueJS tips.'
        ]);

        Article::factory()->for($users->first(), 'author')->create([
            'title' => 'Advance Inertia tips.'
        ]);

        $users->each(function (User $user) {
            Article::factory()->for($user, 'author')->create();
        });
    }
}
