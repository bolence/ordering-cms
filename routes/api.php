<?php

use App\Http\Controllers\Api\ApiOrderController;
use Illuminate\Support\Facades\Route;


Route::resource('orders', ApiOrderController::class)->middleware('auth:api');
