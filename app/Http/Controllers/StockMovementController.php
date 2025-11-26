<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockMovementController extends Controller
{
    public function index()
    {
        $sms = StockMovement::with('item')->latest()->get();
        $items = Item::all();
        return view('stock-movements.index', compact('sms', 'items'));
    }

    public function getall()
    {
        $sms = StockMovement::with('item')->latest()->get();
        return response()->json([
            'status' => 200,
            'data' => $sms
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|exists:items,id',
            'type' => 'required|in:in,out',
            'qty' => 'required|numeric',
            'reference_type' => 'required|string|max:255',
            'reference_id' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $sm = StockMovement::create([
            'item_id' => $request->item_id,
            'type' => $request->type,
            'qty' => $request->qty,
            'reference_type' => $request->reference_type,
            'reference_id' => $request->reference_id
        ]);

        return response()->json([
            'status' => 200,
            'data' => $sm
        ]);
    }

    public function show($id)
    {
        $sm = StockMovement::with('item')->findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $sm
        ]);
    }

    public function update(Request $request, $id)
    {
        $sm = StockMovement::with('item')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'item_id' => 'required|exists:items,id',
            'type' => 'required|in:in,out',
            'qty' => 'required|numeric',
            'reference_type' => 'required|string|max:255',
            'reference_id' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $sm->update([
            'item_id' => $request->item_id,
            'type' => $request->type,
            'qty' => $request->qty,
            'reference_type' => $request->reference_type,
            'reference_id' => $request->reference_id
        ]);

        return response()->json([
            'status' => 200,
            'data' => $sm
        ]);
    }

    public function destroy($id)
    {
        $sm = StockMovement::with('item')->findOrFail($id);
        $sm->delete();

        return response()->json([
            'status' => 200,
            'data' => $sm
        ]);
    }
}
