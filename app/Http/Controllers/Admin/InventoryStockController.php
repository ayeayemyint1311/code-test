<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryStockController extends Controller
{
    public function increaseStock(Request $request, Product $product)
    {
        $request->validate(['amount' => 'required|integer|min:1']);

        $product->increment('quantity', $request->amount);

        return back()->with('success', 'Stock increased successfully.');
    }

    public function decreaseStock(Request $request, Product $product)
    {
        $request->validate(['amount' => 'required|integer|min:1']);

        if ($product->quantity < $request->amount) {
            return back()->with('error', 'Not enough stock to decrease.');
        }

        $product->decrement('quantity', $request->amount);

        return back()->with('success', 'Stock decreased successfully.');
    }
}
