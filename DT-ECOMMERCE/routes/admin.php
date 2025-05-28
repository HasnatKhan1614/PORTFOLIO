<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AuthController,
    OrderController
};
use Illuminate\Support\Facades\DB;


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

Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'index']);
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth','admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function() {
        $counts = DB::table('orders')
        ->select('status', DB::raw('COUNT(*) as count'))
        ->groupBy('status')
        ->get();

        return view('admin.dashboard',compact('counts'));
    })->name('admin');

    Route::get('orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('order-detail/{orderId}', [OrderController::class, 'order_detail']);
    Route::put('order-status/{orderId}', [OrderController::class, 'order_status_update'])->name('order-status.update');

});








