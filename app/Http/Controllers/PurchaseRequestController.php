<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $prs = PurchaseRequest::with('requester')->get();
        $requesters = User::all();
        return view('purchase-requests.index', compact('prs', 'requesters'));
    }

    public function getAll()
    {
        $prs = PurchaseRequest::with('requester')->get();
        return response()->json([
            'status' => 200,
            'data' => $prs
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pr_number' => 'required|string|max:255|unique:purchase_requests',
            'requested_by' => 'required|exists:users,id',
            'status' => 'required|in:draft,pending,approved,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $pr = PurchaseRequest::create([
            'pr_number' => $request->pr_number,
            'requested_by' => $request->requested_by,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'data' => $pr
        ]);
    }

    public function show($id)
    {
        $pr = PurchaseRequest::with('requester')->findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $pr
        ]);
    }

    public function update(Request $request, $id)
    {
        $pr = PurchaseRequest::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'pr_number' => 'required|string|max:255|unique:purchase_requests,pr_number,' . $pr->id,
            'requested_by' => 'required|exists:users,id',
            'status' => 'required|in:draft,pending,approved,rejected',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        }

        $pr->update([
            'pr_number' => $request->pr_number,
            'requested_by' => $request->requested_by,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'data' => $pr
        ]);
    }

    public function destroy($id)
    {
        $pr = PurchaseRequest::with('requester')->find($id);
        $pr->delete();

        return response()->json([
            'status' => 200,
            'data' => $pr
        ]);
    }
}
