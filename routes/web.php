<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::group(['prefix' => 'order'], function () {
    Route::get('create', [OrderController::class, 'create']);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/create', [HomeController::class, 'create']);
