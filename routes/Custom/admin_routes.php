<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\OrganizerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);
Route::apiResource('organizers', OrganizerController::class);
