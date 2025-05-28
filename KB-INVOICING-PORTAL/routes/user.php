<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use Illuminate\Support\Facades\Artisan;

Route::prefix('user')->name('user.')->group(function () {
    Route::middleware('guest:user')->group(function () {
        Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [UserAuthController::class, 'login']);
    });

    Route::middleware('user')->group(function () {

        Route::get('/', function () {
            return view('user.dashboard');
        })->name('dashboard');

        Route::get('orders', [App\Http\Controllers\User\UserController::class, 'orderIndex'])->name('orders.index');
        Route::get('invoice/{id}/{type}', [App\Http\Controllers\User\UserController::class, 'invoice'])->name('orders.invoice');
        Route::get('invoices', [App\Http\Controllers\User\UserController::class, 'invoice_index'])->name('invoices.index');



    });

});
