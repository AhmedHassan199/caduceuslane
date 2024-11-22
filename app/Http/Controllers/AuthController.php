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
        // Get credentials from the validated request
        $credentials = $request->only('email', 'password');

        // Call the login method in AuthService
        $response = $this->authService->login($credentials);

        // If there's an error, return an error response
        if (isset($response['error'])) {
            return ApiResponseHelper::error($response['error'], 401);
        }

        // Wrap user data in a resource
        $userResource = new UserResource($response['user']);

        // Return success response with user info and token
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
        // Call the logout method in AuthService to invalidate the token
        $response = $this->authService->logout($request);

        // Return success response for logout
        return ApiResponseHelper::success($response, 'Logout successful.');
    }
}
