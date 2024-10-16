<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PurchaseResource;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::paginate();

        return PurchaseResource::collection($purchases);
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return response([
            'purchase' => new PurchaseResource($purchase)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return response([
            'message' => 'Purchase deleted successfully'
        ]);
    }
}
