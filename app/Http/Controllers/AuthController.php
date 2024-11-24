<?php

namespace App\Http\Controllers;

use App\Services\Auth\AuthService;
use App\Helpers\ApiResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    // Dependency Injection of AuthService
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle login request.
     * Validate user credentials and return token with user info.
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $response = $this->authService->login($credentials);

        if (isset($response['error'])) {
            return ApiResponseHelper::error($response['error'], 401);
        }

        $userResource = new UserResource($response['user']);

        return ApiResponseHelper::success([
            'user' => $userResource,
            'token' => $response['token'],
        ], 'Login successful.');
    }

    /**
     * Handle logout request.
     * Logout the user and invalidate their session or token.
     */
    public function logout(Request $request)
    {
        $response = $this->authService->logout($request);

        return ApiResponseHelper::success($response, 'Logout successful.');
    }
}
