<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_tests_login(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->postJson(route('api.login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertSuccessful()
            ->assertSee('token');
    }
}
