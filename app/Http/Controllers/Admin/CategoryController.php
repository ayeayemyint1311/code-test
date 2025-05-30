<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::withCount('products')->latest()->paginate(5)
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Category $category)
    {
        // 
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', "You can't delete this item because it has related products!");
        }

        if ($category->sub_categories()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', "You can't delete this item because it has related sub_categories!");
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
