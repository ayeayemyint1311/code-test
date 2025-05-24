<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

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
        return view('admin.categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255', Rule::unique('categories', 'name')->ignore($category->id)],
        ]);


        $category->update($validated);
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(String $id)
    {
        $category = Category::with('products')->find($id);
        if($category->products){
            return redirect()->route('categories.index')
            ->with("error", "You can't delete this item because it have related products!");
        }
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
