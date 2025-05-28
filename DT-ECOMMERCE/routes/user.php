<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\{
    GalleryController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware(['auth','user'])->prefix('user')->group(function () {
    Route::get('/dashboard', function() {
        return view('user.dashboard');
    })->name('user');

    Route::resource('gallery', GalleryController::class);
});







