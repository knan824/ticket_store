<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\CardStoreRequest;
use App\Http\Resources\Website\CardResource;
use App\Models\Card;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::where('user_id', auth()->user()->id)->paginate();

        return CardResource::collection($cards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CardStoreRequest $request)
    {
        $card = $request->storeCard();

        return response([
            'card' => new CardResource($card),
            'message' => 'Card created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        if (!auth()->user()->cards->contains($card)) {
            return response([
                'message' => 'Unauthorized'
            ], 401);
        }

        return response([
            'card' => new CardResource($card)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        if (!auth()->user()->cards->contains($card)) {
            return response([
                'message' => 'Unauthorized'
            ], 401);
        }

        $card->delete();

        return response([
            'message' => 'Card deleted successfully'
        ]);
    }
}
