<?php

use App\Http\Controllers\website\eventController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);
