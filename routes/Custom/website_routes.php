<?php

use App\Http\Controllers\website\eventController;
use App\Http\Controllers\Website\OrganizerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);
Route::apiResource('organizers', OrganizerController::class);
