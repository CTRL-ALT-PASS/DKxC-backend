<?php

namespace App\Http\Controllers;

use App\Models\CustomisationGroup;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomisationGroupController extends Controller
{
    public function index()
    {
        $groups = CustomisationGroup::with('options')->get();

        return response()->json($groups, 200);
    }

    public function forProduct(Product $product)
    {
        $product->load('customisationGroups.options');

        return response()->json($product->customisationGroups, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name'     => 'required|string|max:100',
            'selection_type' => 'required|in:Single,Multiple',
            'is_required'    => 'required|boolean',
        ]);

        $group = CustomisationGroup::create($validated);

        return response()->json(['message' => 'Group created!', 'data' => $group], 201);
    }

    public function update(Request $request, CustomisationGroup $group)
    {
        $validated = $request->validate([
            'group_name'     => 'sometimes|string|max:100',
            'selection_type' => 'sometimes|in:Single,Multiple',
            'is_required'    => 'sometimes|boolean',
        ]);

        $group->update($validated);

        return response()->json(['message' => 'Group updated!', 'data' => $group], 200);
    }

    public function destroy(CustomisationGroup $group)
    {
        $group->delete();

        return response()->json(['message' => 'Group deleted!'], 200);
    }
}
