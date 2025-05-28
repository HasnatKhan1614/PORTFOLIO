<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [UserAuthController::class, 'showLoginForm'])->name('login');


Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created successfully!';
});