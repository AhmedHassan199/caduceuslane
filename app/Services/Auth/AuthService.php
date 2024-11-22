<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Handle login.
     */
    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('UserLogin')->plainTextToken;
            return [
                'user' => $user,
                'token' => $token,
            ];
        }

        return [
            'error' => 'Invalid credentials',
            'status' => 401,
        ];
    }

    /**
     * Handle logout.
     */
    public function logout()
    {
        // Revoke the user's token
        Auth::user()->tokens->each(function ($token) {
            $token->delete();
        });

        return [
            'status' => 'success',
            'message' => 'Logged out successfully',
        ];
    }
}
