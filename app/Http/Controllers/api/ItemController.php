<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{

    public function getAllItems()
    {
        $items = Item::all();
        return response()->json([
            'status' => 'success',
            'data' => $items
        ]);
    }

    public function getItemById($id)
    {
        $item = Item::findorfail($id);

        return response()->json([
            'status' => 'success',
            'data' => $item
        ]);
    }

    public function createItem(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $item = Item::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Item created successfully',
        ]);
    }

    public function updateItem(Request $request, $id)
    {
        $item = Item::findorfail($id);
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric',
        ]);

        $item->update($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Item updated successfully',
        ]);
    }

    public function deleteItem($id)
    {
        $item = Item::findorfail($id);
        $item->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Item deleted successfully'
        ]);
    }
}
