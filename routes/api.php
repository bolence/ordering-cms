<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiOrderItemController;


Route::resource('orders', ApiOrderController::class)->middleware('auth:api');
Route::resource('order_items', ApiOrderItemController::class)->middleware('auth:api');
