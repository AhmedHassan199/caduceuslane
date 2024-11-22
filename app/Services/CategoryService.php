<?php
namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Create a new category.
     */
    public function createCategory(array $data): Category
    {
        return $this->categoryRepository->create($data);
    }

    /**
     * Update an existing category.
     */
    public function updateCategory(Category $category, array $data): Category
    {
        return $this->categoryRepository->update($category, $data);
    }

    /**
     * Delete a category.
     */
    public function deleteCategory(Category $category): void
    {
        $this->categoryRepository->delete($category);
    }

    /**
     * Get all categories.
     */
    public function getCategories()
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Get a category by its ID.
     */
    public function getCategoryById(int $id): ?Category
    {
        return $this->categoryRepository->getById($id);
    }
}
