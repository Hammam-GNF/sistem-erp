<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('invoice')->get();
        $invoices = Invoice::all();
        return view('payments.index', compact('payments', 'invoices'));
    }

    public function getall()
    {
        $payments = Payment::with('invoice')->get();
        return response()->json([
            'status' => 200,
            'data' => $payments
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|decimal:2',
            'payment_date' => 'required|date',
            'method' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $payment = Payment::create([
            'invoice_id' => $request->invoice_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'method' => $request->method
        ]);

        return response()->json([
            'status' => 200,
            'data' => $payment
        ]);
    }

    public function show($id)
    {
        $payment = Payment::with('invoice')->findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $payment
        ]);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::with('invoice')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|decimal:2',
            'payment_date' => 'required|date',
            'method' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $payment->update([
            'invoice_id' => $request->invoice_id,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'method' => $request->method
        ]);

        return response()->json([
            'status' => 200,
            'data' => $payment
        ]);
    }

    public function destroy($id)
    {
        $payment = Payment::with('invoice')->findOrFail($id);
        $payment->delete();

        return response()->json([
            'status' => 200,
            'data' => $payment
        ]);
    }
}
