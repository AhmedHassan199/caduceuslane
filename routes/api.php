<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('is_admin')->group(function () {
    Route::prefix('authors')->group(function () {
        Route::post('/', [AuthorController::class, 'create']);
        Route::get('/', [AuthorController::class, 'index']);
        Route::get('/{id}', [AuthorController::class, 'show']);
        Route::put('/{id}', [AuthorController::class, 'update']);
        Route::delete('/{id}', [AuthorController::class, 'destroy']);
    });
});

    // Category Routes
    Route::middleware('is_admin')->group(function () {
        Route::prefix('categories')->group(function () {
            Route::post('/', [CategoryController::class, 'create']);
            Route::get('/', [CategoryController::class, 'index']);
            Route::put('/{id}', [CategoryController::class, 'update']);
            Route::delete('/{id}', [CategoryController::class, 'destroy']);
        });
        });


        Route::prefix('books')->group(function () {
            Route::post('/', [BookController::class, 'create']);
            Route::get('/', [BookController::class, 'index']);
            Route::get('/{id}', [BookController::class, 'show']);
            Route::put('/{id}', [BookController::class, 'update']);
            Route::delete('/{id}', [BookController::class, 'destroy']);

        });

});



Route::post('/book-import', [BookController::class, 'import']);
Route::get('/book-export', [BookController::class, 'export']);
