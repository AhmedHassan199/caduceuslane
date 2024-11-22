<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Create a new category.
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Update a category.
     */
    public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    /**
     * Delete a category.
     */
    public function delete(Category $category): void
    {
        $category->delete();
    }

    /**
     * Get all categories.
     */
    public function getAll()
    {
        return Category::all();
    }

    /**
     * Get a category by ID.
     */
    public function getById(int $id): ?Category
    {
        return Category::find($id);
    }
}
