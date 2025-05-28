<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{
    DashboardController,
    PurchaseController,
    UserController,
    VendorController,
    ProductController,
    SaleController,
    InventoryController,
    CarModelController,
    MakeController,
    VendorPayableController,
    ExpensePayableController,
    ReportController,
    ExpensePayableHeadController,
    StaffController,
    StaffPayrollController

};
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return Inertia::render("Auth/Login");
})->name('login');

Route::post('/check', [LoginController::class, 'check']);
Route::get('/logout', [LoginController::class, 'destroy']);


Route::middleware('auth.admin')->group(function () {



    Route::get('/', [DashboardController::class, 'index']);

    
    Route::resource('/user', UserController::class);

    Route::resource('/make', CarModelController::class);

    Route::resource('/car-model', CarModelController::class);

    Route::resource('/product', ProductController::class);

    Route::resource('/vendorr', VendorController::class);

    Route::resource('/purchase', PurchaseController::class);

    Route::resource('/sale', SaleController::class);
    Route::get('/get-product-by-barcode/{barcode}', [SaleController::class, 'searchByBarcode']);
    Route::get('/pos', [SaleController::class, 'pos'])->name('pos');
    Route::get('/sale-view/{id}', [SaleController::class, 'view'])->name('view');

    Route::resource('/inventory', InventoryController::class);

    Route::resource('/make', MakeController::class);


    Route::resource('/vendor-payable', VendorPayableController::class);
    Route::get('/get-vendor-balance/{vendor_id}', [VendorPayableController::class, 'vendor_balance']);
    
    Route::resource('/expense-payable-head', ExpensePayableHeadController::class);
    
    Route::resource('/expense-payable', ExpensePayableController::class);

    Route::resource('/staff', StaffController::class);
    Route::resource('/staff-payroll', StaffPayrollController::class);

    //report-inventories
    Route::get('/inventory-report', [ReportController::class, 'InventoryReport']);
    Route::get('/inventory-report-detail/{product_id}', [ReportController::class, 'InventoryReportDetail']);

    //report-inventories
    Route::get('/purchase-report', [ReportController::class, 'PurchaseReport']);
    Route::get('/purchase-report-detail/{vendor_id}', [ReportController::class, 'PurchaseReportDetail']);

    //report-vendor-ledger
    Route::get('/vendor-ledger', [ReportController::class, 'vendorLedger']);
    Route::get('/vendor-ledger-detail/{vendor_id}', [ReportController::class, 'vendorLedgerDetail']);

    Route::get('/expense-payable-head-report', [ReportController::class, 'ExpenseReport']);
    Route::get('/expense-payable-report/{expense_payable_head_id}', [ReportController::class, 'ExpenseReportDetail']);

    Route::get('/staff-payroll-report', [ReportController::class, 'StaffPayrollReport']);
    Route::get('/staff-payroll-report/{staff_id}', [ReportController::class, 'StaffPayrollReportDetail']);



    Route::get('/sale-report', [ReportController::class, 'SaleReport']);
    Route::get('/sale-report-detail', [ReportController::class, 'SaleReportDetail']);

    
});






