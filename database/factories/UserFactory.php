<?php

namespace Database\Factories;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $roles = [Role::ADMIN, Role::EDITOR, Role::USER];

        return [
            'name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => $roles[array_rand($roles)],
        ];
    }

    /** Indicate that the model's email address should be unverified.*/
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /** Indicate that the user has admin role.*/
    public function admin(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => Role::ADMIN,
            ];
        });
    }

    /** Indicate that the user has editor role.*/
    public function editor(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => Role::EDITOR,
            ];
        });
    }

    /** Indicate that the user has user role.*/
    public function user(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => Role::USER,
            ];
        });
    }
}
