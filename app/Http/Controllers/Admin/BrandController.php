<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Services\BrandService;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index()
    {
        return view('admin.brands.index', [
            'brands' => $this->brandService->getAllBrands()
        ]);
    }

    public function store(StoreBrandRequest $request)
    {
        $validated = $request->validated();
        $this->brandService->createBrand($validated);

        return redirect()->route('brands.index')
            ->with('success', 'Brand created successfully!');
    }

    public function update(StoreBrandRequest $request, Brand $brand)
    {
        $validated = $request->validated();
        $this->brandService->updateBrand($brand, $validated);

        return redirect()->route('brands.index')
            ->with('success', 'Brand updated successfully!');
    }

    public function destroy(Brand $brand)
    {
        try {
            $this->brandService->deleteBrand($brand);

            return redirect()->route('brands.index')
                ->with('success', 'Brand deleted successfully!');
                
        } catch (\RuntimeException $e) {
            return redirect()->route('brands.index')
                ->with('error', $e->getMessage());
        }
    }
}
