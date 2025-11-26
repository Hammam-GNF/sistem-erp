<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesOrderController extends Controller
{
    public function index()
    {
        $sos = SalesOrder::with('customer')->latest()->get();
        $customers = Customer::all();
        return view('sales-orders.index', compact('sos', 'customers'));
    }

    public function getall()
    {
        $sos = SalesOrder::with('customer')->latest()->get();
        return response()->json([
            'status' => 200,
            'data' => $sos
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'so_number'   => 'required|string|max:255|unique:sales_orders',
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:open,shipped,closed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $so = SalesOrder::create([
            'so_number' => $request->so_number,
            'customer_id' => $request->customer_id,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'data' => $so
        ]);
    }

    public function show($id)
    {
        $so = SalesOrder::with('customer')->findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $so
        ]);
    }

    public function update(Request $request, $id)
    {
        $so = SalesOrder::with('customer')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'so_number'   => 'required|string|max:255|unique:sales_orders,so_number,' . $so->id,
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:open,shipped,closed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $so->update([
            'so_number' => $request->so_number,
            'customer_id' => $request->customer_id,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'data' => $so
        ]);
    }

    public function destroy($id)
    {
        $so = SalesOrder::with('customer')->findOrFail($id);
        $so->delete();

        return response()->json([
            'status' => 200,
            'data' => $so
        ]);
    }
}
