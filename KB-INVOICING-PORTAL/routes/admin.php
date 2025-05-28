<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use App\Models\OrderDetail;
use App\Models\Renewal;
use App\Models\User;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

    Route::middleware('admin')->group(function () {

        Route::get('/', function () {

            $today = Carbon::today();
            $sevenDaysAgo = Carbon::today()->subDays(6); // last 7 days including today

            // Total payments
            $orderTotal = OrderDetail::whereBetween('created_at', [$sevenDaysAgo, $today])
                ->sum('price');

            $renewalTotal = Renewal::whereBetween('created_at', [$sevenDaysAgo, $today])
                ->sum('renewal_price');

            $totalPayments = $orderTotal + $renewalTotal;

            // New customer count in last 7 days
            $newUsersCount = User::whereBetween('created_at', [$sevenDaysAgo, $today])
                ->count();
            return view('admin.dashboard',compact('totalPayments','newUsersCount'));
        })->name('dashboard');

        Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
        Route::post('users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
        Route::get('users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
        Route::delete('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

        Route::get('servers', [App\Http\Controllers\Admin\ServerController::class, 'index'])->name('servers.index');
        Route::get('servers/create', [App\Http\Controllers\Admin\ServerController::class, 'create'])->name('servers.create');
        Route::post('servers', [App\Http\Controllers\Admin\ServerController::class, 'store'])->name('servers.store');
        Route::get('servers/{id}/edit', [App\Http\Controllers\Admin\ServerController::class, 'edit'])->name('servers.edit');
        Route::put('servers/{id}', [App\Http\Controllers\Admin\ServerController::class, 'update'])->name('servers.update');
        Route::delete('servers/{id}', [App\Http\Controllers\Admin\ServerController::class, 'destroy'])->name('servers.destroy');

        Route::get('products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
        Route::get('products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
        Route::post('products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
        Route::get('products/{id}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
        Route::put('products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');

        Route::get('orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/create', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('orders.create');
        Route::post('orders', [App\Http\Controllers\Admin\OrderController::class, 'store'])->name('orders.store');
        Route::get('orders/{id}/edit', [App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('orders.edit');
        Route::put('orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'update'])->name('orders.update');
        Route::delete('orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');
        Route::post('/orders/toggle-payment-status/{id}', [App\Http\Controllers\Admin\OrderController::class, 'togglePaymentStatus'])->name('orders.togglePaymentStatus');


        Route::get('banks/', [App\Http\Controllers\Admin\BankInformationController::class, 'index'])->name('banks.index');
        Route::get('banks/create', [App\Http\Controllers\Admin\BankInformationController::class, 'create'])->name('banks.create');
        Route::post('banks/', [App\Http\Controllers\Admin\BankInformationController::class, 'store'])->name('banks.store');
        Route::get('banks/{id}/edit', [App\Http\Controllers\Admin\BankInformationController::class, 'edit'])->name('banks.edit');
        Route::put('banks/{id}/update', [App\Http\Controllers\Admin\BankInformationController::class, 'update'])->name('banks.update');
        Route::delete('banks/{id}', [App\Http\Controllers\Admin\BankInformationController::class, 'destroy'])->name('banks.destroy');

        Route::get('/custom-invoices', [App\Http\Controllers\Admin\CustomInvoiceController::class, 'index'])->name('custom-invoices.index');
        Route::get('/custom-invoices/create', [App\Http\Controllers\Admin\CustomInvoiceController::class, 'create'])->name('custom-invoices.create');
        Route::post('/custom-invoices', [App\Http\Controllers\Admin\CustomInvoiceController::class, 'store'])->name('custom-invoices.store');
        Route::get('/custom-invoices/{id}/edit', [App\Http\Controllers\Admin\CustomInvoiceController::class, 'edit'])->name('custom-invoices.edit');
        Route::put('/custom-invoices/{id}', [App\Http\Controllers\Admin\CustomInvoiceController::class, 'update'])->name('custom-invoices.update');
        Route::delete('/custom-invoices/{id}', [App\Http\Controllers\Admin\CustomInvoiceController::class, 'destroy'])->name('custom-invoices.destroy');
        Route::get('/custom-invoices/invoice/{id}', [App\Http\Controllers\Admin\CustomInvoiceController::class, 'invoice'])->name('custom-invoices.invoice');

        
        Route::get('invoice/{id}/{type}', [App\Http\Controllers\Admin\OrderController::class, 'invoice'])->name('orders.invoice');
        Route::get('invoice-pay/{id}', [App\Http\Controllers\Admin\OrderController::class, 'invoice_pay'])->name('orders.invoice.pay');
        Route::get('invoice-send/{invoice_number}/{type}', [App\Http\Controllers\Admin\OrderController::class, 'sendInvoice'])->name('orders.invoice.send');

        Route::get('/invoice', function () {
            return view('admin.invoice.invoice');
        })->name('invoice');

        Route::get('/invoice/pay/{invoice_no}', [App\Http\Controllers\Admin\OrderController::class, 'invoice_pay'])->name('admin.orders.invoice.pay');



        Route::get('invoices', [App\Http\Controllers\Admin\OrderController::class, 'invoice_index'])->name('invoices.index');
        Route::get('notifications', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('notifications.index');

    });

});



Route::post('logout', [App\Http\Controllers\Auth\AdminAuthController::class, 'logout'])->name('logout');

Route::get('payment/success', [App\Http\Controllers\Admin\OrderController::class, 'success'])->name('stripe.success');
Route::get('payment/cancel', [App\Http\Controllers\Admin\OrderController::class, 'cancel'])->name('stripe.cancel');

Route::get('/run-check-renewals', function () {
    // Run the artisan command
    Artisan::call('orders:check-renewals');

    return 'Orders renewal check command has been executed!';
});