<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('purchase.index', compact('suppliers'));
    }

    public function getall()
    {
        $po = PurchaseOrder::with('supplier')->latest()->get();

        return response()->json([
            'status' => 200,
            'data' => $po
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'po_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $po = PurchaseOrder::create([
            'po_number'   => 'PO-' . now()->format('YmdHis'),
            'supplier_id' => $request->supplier_id,
            'po_date'     => $request->po_date,
            'status'      => 'draft',
            'notes'       => $request->notes,
        ]);

        return response()->json([
            'status' => 200,
            'data' => $po
        ]);
    }

    public function show($id)
    {
        $po = PurchaseOrder::find($id);

        return response()->json([
            'status' => 200,
            'data' => $po
        ]);
    }

    public function update(Request $request, $id)
    {
        $po = PurchaseOrder::find($id);

        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'po_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $po->update([
            'supplier_id' => $request->supplier_id,
            'po_date' => $request->po_date,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'status' => 200,
            'data' => $po
        ]);
    }

    public function destroy($id)
    {
        $po = PurchaseOrder::findOrFail($id);
        $po->delete();

        return response()->json([
            'status' => 200,
            'data' => $po
        ]);
    }
}
