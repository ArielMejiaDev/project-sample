<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        /** @var UserFactory $userFactory */
        $userFactory = User::factory();

        $userFactory->admin()->create([
            'name' => 'Admin user',
            'email' => 'admin@mail.com',
        ]);

        $userFactory->editor()->create();

        $userFactory->user()->count(20)->create();
    }
}
