<?php

namespace Tests;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\InteractsWithModels;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use InteractsWithModels;

    protected Authenticatable $admin;
    protected Authenticatable $editor;
    protected Authenticatable $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
        $this->editor = $this->createUser('editor');
        $this->admin = $this->createUser('admin');
    }

    public function createUser($role = 'user'): Authenticatable
    {
        /** @var UserFactory $userFactory */
        $userFactory = User::factory();

        /** @var Authenticatable $user */
        $user = $userFactory->{$role}()->create();

        return $user;
    }
}
