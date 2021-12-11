<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tests_register(): void
    {
        /** @var User $userData */
        $user = User::factory()->user()->make()->toArray();

        $userData = array_merge([
            'password' => 'password',
            'password_confirmation' => 'password',
        ], $user);

        $response = $this->postJson(route('api.register'), $userData);

        $response->assertSuccessful();
    }
}
