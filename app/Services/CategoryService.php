<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::latest()->paginate(5);
    }

    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data)
    {
        return $category->update($data);
    }

    public function deleteCategory(Category $category)
    {
        if ($category->products()->exists()) {
            throw new \RuntimeException("Cannot delete category with related products");
        }

        return $category->delete();
    }
}
