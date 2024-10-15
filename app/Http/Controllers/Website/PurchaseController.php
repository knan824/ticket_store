<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\PurchaseStoreRequest;
use App\Http\Resources\Website\PurchaseResource;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = auth()->user()->purchases()->paginate();

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
     * Store a newly created resource in storage.
     */
    public function store(PurchaseStoreRequest $request)
    {
        $purchase = $request->storePurchase();

        return response([
            'purchase' => new PurchaseResource($purchase['purchase']),
            'message' => $purchase['success'] ? 'Purchase created successfully' : 'Purchase failed',
        ]);
    }
}
