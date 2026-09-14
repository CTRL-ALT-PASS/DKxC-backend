<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryItem;
use Illuminate\Validation\Rule;


class InventoryItemController extends Controller
{
    //gitgud
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => InventoryItem::all()
        ]);
    }
    //getgetgetgetgetgetgetgetgetgetgetgetgetgetgetgetgetgetgetgetget
    public function show($id)
    {
        $inventoryItem = InventoryItem::find($id);
        if ($inventoryItem) {
            return response()->json([
                'success' => true,
                'data' => $inventoryItem
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Inventory item not found'
            ], 404);
        }
    }
    //post traumatic system disorder
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity_on_hand' => 'required|integer',
            'last_restocked' => 'nullable|date',
            'inventory_status' => ['required', Rule::in(['in_stock', 'out_of_stock', 'discontinued'])],
        ]);

        $inventoryItem = InventoryItem::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Inventory item created successfully',
            'data' => $inventoryItem
        ], 201);
    }
    //put tank in a mall
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'branch_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity_on_hand' => 'required|integer',
            'last_restocked' => 'nullable|date',
            'inventory_status' => ['required', Rule::in(['in_stock', 'out_of_stock', 'discontinued'])],
        ]);
        $inventoryItem = InventoryItem::find($id);
        if ($inventoryItem) {
            $inventoryItem->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Inventory item updated successfully',
                'data' => $inventoryItem
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Inventory item not found'
            ], 404);
        }
    }
    //delete yourself NOW!!!
    public function destroy($id)
    {
        $inventoryItem = InventoryItem::find($id);
        if ($inventoryItem) {
            $inventoryItem->delete();
            return response()->json([
                'success' => true,
                'message' => 'Inventory item deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Inventory item not found'
            ], 404);
        }
    }
}
