<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{

    public function index(Product $product)
    {
        return response()->json($product->sizes, 200);
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
			'product_id' => 'required|exists:product,product_id',
            'size_label' => 'required|string|max:50',
            'price' 	 => 'required|numeric|min:0',
        ]);

        $size = $product->sizes()->create($validated);
        return response()->json(['message' => 'Size added!', 'data' => $size], 201);
    }

    public function update(Request $request, ProductSize $productSize)
    {
        $validated = $request->validate([
            'size_label' => 'sometimes|string|max:50',
            'price' 	 => 'sometimes|numeric|min:0',
        ]);

        $productSize->update($validated);
        return response()->json(['message' => 'Size updated!', 'data' => $productSize], 200);
    }

    public function destroy(ProductSize $productSize)
    {
        $productSize->delete();
        return response()->json(['message' => 'Size deleted!'], 200);
    }
}