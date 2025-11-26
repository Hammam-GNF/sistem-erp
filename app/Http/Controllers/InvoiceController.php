<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    public function getall()
    {
        $invoices = Invoice::all();
        return response()->json([
            'status' => 200,
            'data' => $invoices
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invoice_number' => 'required|unique:invoices',
            'type' => 'required|in:purchase,sales',
            'ref_id' => 'required|numeric',
            'total' => 'required|decimal:2',
            'status' => 'required|in:paid,unpaid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'type' => $request->type,
            'ref_id' => $request->ref_id,
            'total' => $request->total,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'data' => $invoice
        ]);
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $invoice
        ]);
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'invoice_number' => 'required|unique:invoices,invoice_number,' . $invoice->id,
            'type' => 'required|in:purchase,sales',
            'ref_id' => 'required|numeric',
            'total' => 'required|decimal:2',
            'status' => 'required|in:paid,unpaid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'type' => $request->type,
            'ref_id' => $request->ref_id,
            'total' => $request->total,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'data' => $invoice
        ]);
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json([
            'status' => 200,
            'data' => $invoice
        ]);
    }
}
