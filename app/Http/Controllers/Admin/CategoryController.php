<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.categories.index', [
            'categories' => $this->categoryService->getAllCategories()
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $this->categoryService->createCategory($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $this->categoryService->updateCategory($category, $validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        try {
            $this->categoryService->deleteCategory($category);

            return redirect()->route('categories.index')
                ->with('success', 'Category deleted successfully!');

        } catch (\RuntimeException $e) {
            return redirect()->route('categories.index')
                ->with('error', $e->getMessage());
        }
    }
}
