<?php

use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\website\eventController;
use App\Http\Controllers\Website\OrganizerController;
use App\Http\Controllers\Website\TicketController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);
Route::apiResource('organizers', OrganizerController::class);
Route::apiResource('categories', CategoryController::class)->only('show','index');
Route::apiResource('tickets', TicketController::class);

