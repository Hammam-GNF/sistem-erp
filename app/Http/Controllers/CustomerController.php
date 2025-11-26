<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function getAll()
    {
        $customers = Customer::all();
        return response()->json([
            'status' => 200,
            'data' => $customers
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return response()->json([
            'status' => 200,
            'data' => $customer
        ]);
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $customer
        ]);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $customer->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return response()->json([
            'status' => 200,
            'data' => $customer
        ]);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return response()->json([
            'status' => 200,
            'data' => $customer
        ]);
    }
}
