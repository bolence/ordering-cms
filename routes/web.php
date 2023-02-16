<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;


Auth::routes();

Route::group(['prefix' => 'order', 'middleware' => ['auth']], function () {
    Route::get('create', [OrderController::class, 'create']);
});

Route::resource('customers', CustomerController::class)->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
