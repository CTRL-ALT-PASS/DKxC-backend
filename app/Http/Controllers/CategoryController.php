<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //get got
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Category::all()
        ]);
    }

    //get get
    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }
    }

    //then he clicked post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    //put tank in a mall
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category) {
            $validated = $request->validate([
                'category_name' => 'required|string|max:100',
                'description' => 'nullable|string',
            ]);

            $category->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully',
                'data' => $category
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }
    }

    //delete yourself NOW!!!
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }
    }
}
