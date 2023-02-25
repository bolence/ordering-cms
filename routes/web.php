<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;


Auth::routes();

// Route::group(['prefix' => 'order', 'middleware' => ['auth']], function () {
//     Route::get('/', [OrderController::class, 'tshirt']);
//     Route::get('create', [OrderController::class, 'create']);
//     Route::get('/{id}', [OrderController::class, 'show']);
// });

Route::get('order/finished', [OrderController::class, 'finished_orders'])->middleware('auth');
Route::resource('order', OrderController::class)->middleware('auth');

Route::resource('customers', CustomerController::class)->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/notifications', [HomeController::class, 'notifications'])->middleware('auth');
