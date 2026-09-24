<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    // GET ALL
    public function index(Request $request)
    {
        $items = InventoryItem::query();

        if ($request->has('product_id')) {
            $items->where('product_id', $request->query('product_id'));
        }

        if ($request->has('branch_id')) {
            $items->where('branch_id', $request->query('branch_id'));
        }

        if ($request->has('inventory_status')) {
            $items->where('inventory_status', $request->query('inventory_status'));
        }

        return response()->json($items->get(), 200);
    }

    // GET ONE
    public function show(InventoryItem $inventoryItem)
    {
        return response()->json($inventoryItem, 200);
    }

    // CREATE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id'        => 'required|integer',
            'product_id'       => 'required|integer|exists:product,product_id',
            'quantity_on_hand' => 'required|integer|min:0',
            'last_restocked'   => 'nullable|date',
            'inventory_status' => 'required|in:Available,Low Stock,Out of Stock',
        ]);

        $inventoryItem = InventoryItem::create($validated);

        return response()->json(['message' => 'Inventory created!', 'data' => $inventoryItem], 201);
    }

    // UPDATE
    public function update(Request $request, InventoryItem $inventoryItem)
    {
        $validated = $request->validate([
            'branch_id'        => 'sometimes|integer',
            'product_id'       => 'sometimes|integer|exists:product,product_id',
            'quantity_on_hand' => 'sometimes|integer|min:0',
            'last_restocked'   => 'sometimes|date',
            'inventory_status' => 'sometimes|in:Available,Low Stock,Out of Stock',
        ]);

        $inventoryItem->update($validated);

        return response()->json(['message' => 'Inventory updated!', 'data' => $inventoryItem], 200);
    }

    // DELETE
    public function destroy(InventoryItem $inventoryItem)
    {
        $inventoryItem->delete();

        return response()->json(['message' => 'Inventory deleted!'], 200);
    }
}
