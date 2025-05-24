<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->withTrashed();

        $totalStockValue = Product::sum(DB::raw('quantity * price'));

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->input('brand_id'));
        }

        return view('admin.products.index', [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'totalStockValue' => $totalStockValue,
            'products' => $query->paginate(10)
        ]);
    }


    public function create()
    {
        // 
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        // Check image insert or not
        if ($request->file('image')) {
            // Store image using storage:link method
            $path = $request->file('image')->store('images/products', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);
        return redirect()->route('products.index')
            ->with('success', 'Prodcut created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Store new image
            $update_path = $request->file('image')->store('images/products', 'public');
            $validated['image'] = $update_path;

            // Delete the old image from storage
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
        }

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Prodcut deleted successfully!');
    }

    public function forceDelete(String $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        // Delete the image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->forceDelete();

        return redirect()->route('products.trashed')
            ->with('success', 'Product permanently deleted.');
    }

    public function restore(String $id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('products.index')
            ->with('success', 'Prodcut restored successfully!');
    }
}
