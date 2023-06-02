<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\RoleController;
use App\Models\Payment;
use Illuminate\Support\Facades\Route;

/**
 * Admin Route is reponsible for all 
 * admin request
 */

Route::get('/admin/login', [AdminController::class, 'create_login'])->name("admin.login.create");
Route::post('/admin/login', [AdminController::class, 'store_login'])->name("admin.login.store");
Route::get('/admin/forgot-password', [ResetPasswordController::class, 'create'])->name('admin.forgot.password');
Route::post('/admin/forgot-password', [ResetPasswordController::class, 'store'])->name('admin.forgot.password.store');

Route::prefix("admin")->name("admin.")->middleware(['is_admin'])->group(function() {
    Route::get("/", [AdminController::class, 'dashboard'])->name("index");

    Route::get("/clients", [AdminController::class, "clients"])->name('clients');
    Route::get("/profile", [AdminController::class, "profile"])->name("profile");
    Route::post('admin/logout', [AdminController::class, 'logout'])->name("user.logout");
    Route::resource("/users", AdminController::class);

    /**
     * All clients route list
     */
    Route::resource("clients", ClientController::class);

    /**
     * All Category route list
     */
    Route::resource("category", CategoryController::class);
    
    /**
     * All Blog route list
     */
    Route::resource('blogs', BlogController::class);

    /**
     * All Role route list
     */
    Route::get('/permission/{role}', [RoleController::class, 'permission'])->name('permission');
    Route::post('/permission/{role}', [RoleController::class, 'store_permission'])->name('permission_store');
    Route::resource("roles", RoleController::class);
    
    /**
     * Order route list
     */
    Route::resource("orders", OrderController::class);

    /**
     * payment list
     */
    Route::get('/payment/list', function() {
        $payments = Payment::orderBy('id', 'desc')->get();
        return view('admin.payment', compact('payments'));
    })->name('payment.list');
});
