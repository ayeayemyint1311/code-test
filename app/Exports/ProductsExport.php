<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::with(['category', 'brand'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Code',
            'Category',
            'Brand',
            'Price',
            'Quantity',
            'Description',
            'Created At'
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->code,
            $product->category->name,
            $product->brand->name,
            $product->price,
            $product->quantity,
            $product->description,
            $product->created_at->format('Y-m-d H:i:s'),
        ];
    }
}