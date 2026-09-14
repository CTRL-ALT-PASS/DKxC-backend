<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET ALL PRODUCTS
    public function index()
    {
        $products = Product::with('category')->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);
    }

    // GET ONE PRODUCT
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }

    // CREATE PRODUCT
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|integer|exists:category,category_id',
            'product_name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'selling_price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'reorder_level' => 'nullable|integer|min:0',
            'product_status' => 'nullable|in:Active,Inactive,Discontinued',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully.',
            'data' => $product
        ], 201);
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        $validated = $request->validate([
            'category_id' => 'sometimes|required|integer|exists:category,category_id',
            'product_name' => 'sometimes|required|string|max:100',
            'description' => 'nullable|string|max:255',
            'selling_price' => 'sometimes|required|numeric|min:0',
            'cost_price' => 'sometimes|required|numeric|min:0',
            'reorder_level' => 'nullable|integer|min:0',
            'product_status' => 'nullable|in:Active,Inactive,Discontinued',
        ]);

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully.',
            'data' => $product
        ], 200);
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.'
        ], 200);
    }
}