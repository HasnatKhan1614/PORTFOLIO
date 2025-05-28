<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MaintenanceRequestItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created successfully.';
});
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        $data = [
            'totalCompanies' => App\Models\Company::count(),
            'totalBuildings' => App\Models\Building::count(),
            'totalMaintenances' => App\Models\MaintenanceRequest::count(),
            'totalUsers' => App\Models\User::count(),
        ];

        return view('dashboard', $data);
    })->name('dashboard');




    Route::get('/companies', [CompanyController::class, 'index']); // List all companies
    Route::get('/companies/show/{id}', [CompanyController::class, 'show']); // List all companies
    Route::get('/companies/create', [CompanyController::class, 'create']); // Show create form
    Route::post('/companies/store', [CompanyController::class, 'store']); // Save new company
    Route::get('/companies/edit/{id}', [CompanyController::class, 'edit']); // Show edit form
    Route::post('/companies/update/{id}', [CompanyController::class, 'update']); // Update company
    Route::delete('/companies/delete/{id}', [CompanyController::class, 'destroy']); // Delete company

    Route::get('/buildings', [BuildingController::class, 'index']);
    Route::get('/buildings/create', [BuildingController::class, 'create']);
    Route::post('/buildings/store', [BuildingController::class, 'store']);
    Route::get('/buildings/edit/{id}', [BuildingController::class, 'edit']);
    Route::post('/buildings/update/{id}', [BuildingController::class, 'update']);
    Route::delete('/buildings/delete/{id}', [BuildingController::class, 'destroy']);

    Route::get('/maintenance-requests', [MaintenanceRequestController::class, 'index']);
    Route::get('/maintenance-requests/finished', [MaintenanceRequestController::class, 'index_finished']);
    Route::get('/maintenance-requests/show/{id}', [MaintenanceRequestController::class, 'show']);
    Route::get('/maintenance-requests/create', [MaintenanceRequestController::class, 'create']);
    Route::post('/maintenance-requests/store', [MaintenanceRequestController::class, 'store']);
    Route::get('/maintenance-requests/edit/{id}', [MaintenanceRequestController::class, 'edit']);
    Route::post('/maintenance-requests/update/{id}', [MaintenanceRequestController::class, 'update']);
    Route::delete('/maintenance-requests/delete/{id}', [MaintenanceRequestController::class, 'destroy']);


    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');


    Route::get('/maintenance-items', [MaintenanceRequestItemController::class, 'index']);
    Route::get('/maintenance-items/create', [MaintenanceRequestItemController::class, 'create']);
    Route::post('/maintenance-items/store', [MaintenanceRequestItemController::class, 'store']);
    Route::get('/maintenance-items/edit/{id}', [MaintenanceRequestItemController::class, 'edit']);
    Route::post('/maintenance-items/update/{id}', [MaintenanceRequestItemController::class, 'update']);
    Route::delete('/maintenance-items/delete/{id}', [MaintenanceRequestItemController::class, 'destroy']);
    Route::get('/maintenance-items/download/{id}', [MaintenanceRequestItemController::class, 'download'])->name('maintenance-items.download');
    Route::get('/maintenance-items/download-attachments/{id}', [MaintenanceRequestItemController::class, 'downloadAllAttachments'])
        ->name('maintenance-items.downloadAllAttachments');
    Route::get('/users',[UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/companies/report', function () {
        if (!auth()->user()->can('report-company')) {
            abort(403, 'Unauthorized');
        }
        $companies = App\Models\Company::all();
        return view('pages.report.company', compact('companies'));
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
