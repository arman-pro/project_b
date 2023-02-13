<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\OrderController;
use Illuminate\Support\Facades\Route as Route;

/**
 * dashboard route is responsible for user clients
 */
Route::name("dashboard.")->prefix('dashboard')->middleware(['auth'])->group(function() {
    Route::get('/', [DashboardController::class, "index"])->name('index');

    Route::resource("orders", OrderController::class);

    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('profile', [DashboardController::class, 'update_profile'])->name('profile.update');

});
