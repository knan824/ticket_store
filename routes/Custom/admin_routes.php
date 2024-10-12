<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\OrganizerController;
use App\Http\Controllers\Admin\TicketController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);
Route::apiResource('organizers', OrganizerController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('tickets', TicketController::class);
