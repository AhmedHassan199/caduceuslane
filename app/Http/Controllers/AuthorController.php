<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Http\Requests\CreateAuthorRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Helpers\ApiResponseHelper;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    // Create an author
    public function create(CreateAuthorRequest $request)
    {
        $data = $request->validated();
        $author = $this->authorService->create($data);
        return ApiResponseHelper::success(new UserResource($author), 'Author created successfully.', 201);
    }

    // Get all authors
    public function index()
    {

        $authors = $this->authorService->getAll();
        return ApiResponseHelper::success(UserResource::collection($authors), 'Authors retrieved successfully.');
    }


    // Get a specific author
    public function show($id)
    {
        $author = $this->authorService->getById($id);
        if (!$author) {
            return ApiResponseHelper::error('Author not found', 404);
        }
        return ApiResponseHelper::success(new UserResource($author), 'Author details retrieved successfully.');
    }

    // Update an author
    public function update(CreateAuthorRequest $request, $id)
    {
        $data = $request->validated();
        $author = $this->authorService->getById($id);
        if (!$author) {
            return ApiResponseHelper::error('Author not found', 404);
        }
        $updatedAuthor = $this->authorService->update($author, $data);
        return ApiResponseHelper::success(new UserResource($updatedAuthor), 'Author updated successfully.');
    }

    // Delete an author
    public function destroy($id)
    {
        $author = $this->authorService->getById($id);
        if (!$author) {
            return ApiResponseHelper::error('Author not found', 404);
        }
        $this->authorService->delete($author);
        return ApiResponseHelper::success(null, 'Author deleted successfully.');
    }
}
