<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:brands,name|max:255',
        ]);

        Brand::create($validated);
        return redirect()->route('brands.index')
            ->with('success', 'Brand created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', [
            'brand' => $brand
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255', Rule::unique('brands', 'name')->ignore($brand->id)],
        ]);


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
