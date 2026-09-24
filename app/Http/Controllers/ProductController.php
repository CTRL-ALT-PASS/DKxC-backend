<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET ALL
    public function index(Request $request)
    {
        $products = Product::query();

        if ($request->has('search')) {
            $products->where('product_name', 'like', "%{$request->query('search')}%");
        }

        if ($request->has('category_id')) {
            $products->where('category_id', $request->hasQuery('category_id'));
        }

        if ($request->has('product_status')) {
            $products->where('product_status', $request->hasQuery('product_status'));
        }

        return response()->json($products->get(), 200);
    }

    // GET ONE
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    // CREATE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'    => 'required|exists:category,category_id',
            'product_name'   => 'required|string|max:100',
            'description'    => 'nullable|string|max:255',
            'selling_price'  => 'required|numeric|min:0',
            'cost_price'     => 'required|numeric|min:0',
            'reorder_level'  => 'required|integer|min:0',
            'product_status' => 'required|in:Active,Inactive,Discontinued',
        ]);

        $product = Product::create($validated);

        return response()->json(['message' => 'Product created successfully!', 'data' => $product], 201);
    }

    // UPDATE
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id'    => 'sometimes|exists:category,category_id',
            'product_name'   => 'sometimes|string|max:100',
            'description'    => 'sometimes|nullable|string|max:255',
            'selling_price'  => 'sometimes|numeric|min:0',
            'cost_price'     => 'sometimes|numeric|min:0',
            'reorder_level'  => 'sometimes|integer|min:0',
            'product_status' => 'sometimes|in:Active,Inactive,Discontinued',
        ]);

        $product->update($validated);

        return response()->json(['message' => 'Product updated successfully!', 'data' => $product], 200);
    }

    // DELETE
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully!'], 200);
    }
}
