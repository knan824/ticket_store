<?php

use App\Http\Controllers\Admin\eventController;
use Illuminate\Support\Facades\Route;

Route::apiResource('events', EventController::class);
