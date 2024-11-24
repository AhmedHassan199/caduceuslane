<?php

namespace App\Exceptions;

use App\Helpers\ApiResponseHelper;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            // Handle Validation Exception
            $errors = $exception->errors();
            return ApiResponseHelper::error('Validation Error', 422, $errors);
        }
        if ($exception instanceof AuthenticationException) {
            return ApiResponseHelper::error('You must be logged in to access this resource.', 401);
        }
        if ($exception instanceof HttpResponseException) {
            // Handle HttpResponseException
            return ApiResponseHelper::error('Bad Request', 400);
        }

        // Handle ModelNotFoundException (e.g., when a resource is not found)
        if ($exception instanceof ModelNotFoundException) {
            return ApiResponseHelper::error('Item Not Found', 404);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'message' => 'You are not authorized to perform this action.',
                'code' => 403,
            ], 403);
        }
        // Handle other types of exceptions (e.g., AuthenticationException)
        return parent::render($request, $exception);
    }
}
