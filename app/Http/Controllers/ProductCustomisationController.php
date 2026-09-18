<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CustomisationGroup;
use Illuminate\Http\Request;

class ProductCustomisationController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:customisation_group,group_id',
        ]);

        if ($product->customisationGroups()->where('product_customisation.group_id', $validated['group_id'])->exists()) {
            return response()->json(['message' => 'Group is already linked to this product.'], 200);
        }

        $product->customisationGroups()->attach($validated['group_id']);

        return response()->json(['message' => 'Group linked to product!'], 201);
    }

    public function destroy(Product $product, $groupId)
    {
        $product->customisationGroups()->detach($groupId);

        return response()->json(['message' => 'Group unlinked from product!'], 200);
    }
}
