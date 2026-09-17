<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET ALL
    public function index()
	{
        return response()->json(Category::all(), 200);
    }

    // GET ONE
    public function show(Category $category)
	{
        return response()->json($category, 200);
    }

    // CREATE
    public function store(Request $request)
	{
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        $category = Category::create($validated);
    
        return response()->json(['message' => 'Category created successfully!', 'data' => $category], 201);
    }

    // UPDATE
    public function update(Request $request, Category $category)
	{
        $validated = $request->validate([
            'category_name' => 'sometimes|string|max:255',
            'description'   => 'sometimes|string',
        ]);

        $category->update($validated);

        return response()->json(['message' => 'Category updated successfully!', 'data' => $category], 201);
    }

    // DELETE
    public function destroy(Category $category)
	{
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully!'], 200);
    }
}
