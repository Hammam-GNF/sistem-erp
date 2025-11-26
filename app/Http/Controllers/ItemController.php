<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function getAll()
    {
        $items = Item::all();
        return response()->json([
            'status' => 200,
            'data' => $items
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sku' => 'required|string|max:255|unique:items',
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'min_stock' => 'required|integer',
            'price' => 'required|decimal:2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $item = Item::create([
            'sku' => $request->sku,
            'name' => $request->name,
            'unit' => $request->unit,
            'min_stock' => $request->min_stock,
            'price' => $request->price
        ]);

        return response()->json([
            'status' => 200,
            'data' => $item
        ]);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'sku' => 'required|string|max:255|unique:items,sku,' . $item->id,
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'min_stock' => 'required|integer',
            'price' => 'required|decimal:2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $item->update([
            'sku' => $request->sku,
            'name' => $request->name,
            'unit' => $request->unit,
            'min_stock' => $request->min_stock,
            'price' => $request->price
        ]);

        return response()->json([
            'status' => 200,
            'data' => $item
        ]);
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        return response()->json([
            'status' => 200,
            'data' => $item
        ]);
    }
}
