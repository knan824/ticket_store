<?php

use App\Http\Controllers\Website\CardController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\website\eventController;
use App\Http\Controllers\Website\OrganizerController;
use App\Http\Controllers\Website\PurchaseController;
use App\Http\Controllers\Website\TicketController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('events', EventController::class)->only(['index', 'show']);
Route::apiResource('organizers', OrganizerController::class)->only(['index', 'show']);
Route::apiResource('tickets', TicketController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('cards', CardController::class)->except(['update']);
    Route::apiResource('purchases', PurchaseController::class)->except(['update', 'delete']);
});

