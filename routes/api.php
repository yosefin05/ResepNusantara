<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiResepController;

Route::apiResource('reseps', ApiResepController::class);
