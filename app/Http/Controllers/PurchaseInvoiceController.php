<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceItem;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PurchaseInvoiceController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $pos = PurchaseOrder::with('supplier')->whereIn('status', ['draft', 'approved', 'ordered'])->get();
        return view('purchase_invoice.index', compact('pos', 'products'));
    }

    public function getall()
    {
        $pi = PurchaseInvoice::with(['supplier','purchaseOrder'])->latest()->get();

        return response()->json([
            'status' => 200,
            'data' => $pi
        ]);
    }

    public function loadPO($poId)
    {
        $po = PurchaseOrder::with(['items.product', 'supplier'])->find($poId);
        if (!$po) {
            return response()->json([
                'status' => 404,
                'message' => 'PO not found'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $po, 
            'items' => $po->items
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'po_id' => 'required|exists:purchase_orders,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'pi_date' => 'required|date',
            'due_date' => 'nullable|date',
            'total_amount' => 'required|numeric|min:0',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        try {
            DB::beginTransaction();

            $po = PurchaseOrder::with('supplier')->findOrFail($request->po_id);

            $totalAmount = collect($request->items)->sum(function ($item) {
                return $item['qty'] * $item['price'];
            });

            $pi = PurchaseInvoice::create([
                'pi_number' => 'PI-' . now()->format('Ymd') . '-' . rand(1000,9999),
                'po_id' => $po->id,
                'supplier_id' => $po->supplier_id,
                'pi_date' => $request->pi_date,
                'due_date' => $request->due_date,
                'total_amount' => $totalAmount,
                'notes' => $request->notes,
                'status' => 'unpaid',
            ]);

            foreach ($request->items as $item) {
                PurchaseInvoiceItem::create([
                    'purchase_invoice_id' => $pi->id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['qty'] * $item['price'],
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => 200,
                'data' => $pi
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Error: '.$e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        $pi = PurchaseOrder::with(['supplier', 'items.product'])->findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $pi
        ]);
    }

    public function update(Request $request, $id)
    {
        $pi = PurchaseInvoice::find($id);

        $validator = Validator::make($request->all(), [
            'pi_date' => 'required|date',
            'due_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'status' => 'required|in:unpaid,paid,partial',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        try {
            DB::beginTransaction();

            $pi = PurchaseInvoice::findOrFail($id);

            $pi->update([
                'pi_date' => $request->pi_date,
                'due_date' => $request->due_date,
                'notes' => $request->notes,
                'status' => $request->status,
            ]);

            DB::commit();
            return response()->json([
                'status' => 200,
                'data' => $pi
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => "Error: ".$e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        $pi = PurchaseInvoice::findOrFail($id);
        $pi->delete();

        return response()->json([
            'status' => 200,
            'data' => $pi
        ]);
    }
}
