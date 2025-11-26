<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $pos = PurchaseOrder::with('purchaseRequest','supplier')->latest()->get();
        $prs = PurchaseRequest::with('requester')->get();
        $suppliers = Supplier::all();
        return view('purchase-orders.index', compact('prs','pos','suppliers'));
    }

    public function getall()
    {
        $pos = PurchaseOrder::with('purchaseRequest','supplier')->latest()->get();
        return response()->json([
            'status' => 200,
            'data' => $pos
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'po_number'   => 'required|string|max:255|unique:purchase_orders',
            'purchase_request_id' => 'required|exists:purchase_requests,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:open,received,closed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $po = PurchaseOrder::create([
            'po_number' => $request->po_number,
            'purchase_request_id' => $request->purchase_request_id,
            'supplier_id' => $request->supplier_id,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'data' => $po
        ]);
    }

    public function show($id)
    {
        $po = PurchaseOrder::with('purchaseRequest','supplier')->findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $po
        ]);
    }

    public function update(Request $request, $id)
    {
        $po = PurchaseOrder::with('purchaseRequest','supplier')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'po_number'   => 'required|string|max:255|unique:purchase_orders,po_number,' . $po->id,
            'purchase_request_id' => 'required|exists:purchase_requests,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:open,received,closed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $po->update([
            'po_number' => $request->po_number,
            'purchase_request_id' => $request->purchase_request_id,
            'supplier_id' => $request->supplier_id,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'data' => $po
        ]);
    }

    public function destroy($id)
    {
        $po = PurchaseOrder::with('purchaseRequest','supplier')->findOrFail($id);
        $po->delete();

        return response()->json([
            'status' => 200,
            'data' => $po
        ]);
    }
}
