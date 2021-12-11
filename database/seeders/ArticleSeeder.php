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

        $users->each(function (User $user) {
            Article::factory()->for($user, 'author')->create();
        });
    }
}
