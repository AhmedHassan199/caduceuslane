<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Helpers\ApiResponseHelper;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

        // Ensure only admins can manage categories
        $this->middleware('is_admin');
    }

    /**
     * Create a new category.
     */
    public function create(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->categoryService->createCategory($data);

        return ApiResponseHelper::success(new CategoryResource($category), 'Category created successfully');
    }

    /**
     * Get all categories.
     */
    public function index()
    {
        $categories = $this->categoryService->getCategories();
        return ApiResponseHelper::success(CategoryResource::collection($categories), 'Categories retrieved successfully');
    }

    /**
     * Update an existing category.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categoryService->getCategoryById($id);

        if (!$category) {
            return ApiResponseHelper::error('Category not found', 404);
        }

        $data = $request->validated();
        $updatedCategory = $this->categoryService->updateCategory($category, $data);

        return ApiResponseHelper::success(new CategoryResource($updatedCategory), 'Category updated successfully');
    }

    /**
     * Delete a category.
     */
    public function destroy($id)
    {
        $category = $this->categoryService->getCategoryById($id);

        if (!$category) {
            return ApiResponseHelper::error('Category not found', 404);
        }

        $this->categoryService->deleteCategory($category);
        return ApiResponseHelper::success([], 'Category deleted successfully');
    }
}
