<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Support\Arr;

class BrandService
{
   public function getAllBrands()
   {
        return Brand::latest()->paginate(5);
   }

   public function createBrand(array $data)
   {
        return Brand::create($data);
   }

   public function updateBrand(Brand $brand, array $data)
   {
        return $brand->update($data);
   }

   public function deleteBrand(Brand $brand)
   {
        if($brand->products()->exits()){
            throw new \RuntimeException("Cannot delete brand with related products");
        }

        return $brand->delete();
   }
}
