<?php

namespace App\Repositories\Auth;

use App\Models\User;

class AuthRepository
{
    /**
     * Find a user by email.
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
