<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brands.index', [
            'brands' => Brand::withCount('products')->latest()->paginate(5)
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreBrandRequest $request)
    {
        $validated = $request->validated();
        Brand::create($validated);

        return redirect()->route('brands.index')
            ->with('success', 'Brand created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        // 
    }

    public function update(StoreBrandRequest $request, Brand $brand)
    {
        $validated = $request->validated();
        $brand->update($validated);

        return redirect()->route('brands.index')
            ->with('success', 'Brand updated successfully!');
    }

    public function destroy(String $id)
    {
        $brand = Brand::with('products')->find($id);
        if($brand->products){
            return redirect()->route('brands.index')
            ->with("error", "You can't delete this item because it have related products!");
        }
        $brand->delete();
        return redirect()->route('brands.index')
            ->with('success', 'Brand deleted successfully!');
    }
}
