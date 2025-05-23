<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Product A',
                'code' => 'PROD001',
                'category_id' => 1,
                'brand_id' => 1,
                'price' => 99.99,
                'quantity' => 10,
                'image' => 'images/electronics.jpeg',
                'description' => 'Description for Product A',
            ],
            [
                'name' => 'Product B',
                'code' => 'PROD002',
                'category_id' => 2,
                'brand_id' => 1,
                'price' => 149.99,
                'quantity' => 5,
                'image' => 'images/clothing.jpg',
                'description' => 'Description for Product B',
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
