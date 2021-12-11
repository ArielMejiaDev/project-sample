<?php

namespace App\Traits;

use App\Enums\Role;

trait HasRoles
{
    public function isAdmin(): bool
    {
        return $this->role == Role::ADMIN;
    }

    public function isEditor(): bool
    {
        return $this->role == Role::EDITOR;
    }

    public function isUser(): bool
    {
        return $this->role == Role::USER;
    }
}
