<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function getAll()
    {
        $suppliers = Supplier::all();
        return response()->json([
            'status' => 200,
            'data' => $suppliers
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

        $supplier = Supplier::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return response()->json([
            'status' => 200,
            'data' => $supplier
        ]);
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $supplier
        ]);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

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

        $supplier->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return response()->json([
            'status' => 200,
            'data' => $supplier
        ]);
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return response()->json([
            'status' => 200,
            'data' => $supplier
        ]);
    }
}
