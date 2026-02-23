<?php

use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetController;
<<<<<<< HEAD
use App\Http\Controllers\DashboardController;
=======
use App\Http\Controllers\AssetFinderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DigitalAssetController;
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/toggle-dark-mode', function () {
        session(['dark_mode' => !session('dark_mode')]);
        return back();
    })->name('toggle-dark-mode');

    Route::resource('assets', AssetController::class);
    Route::post('assets/{asset}/check-out', [AssetController::class, 'checkOut'])->name('assets.check-out');
    Route::post('assets/{asset}/check-in', [AssetController::class, 'checkIn'])->name('assets.check-in');
    Route::post('assets/bulk', [AssetController::class, 'bulkAction'])->name('assets.bulk');
    Route::get('assets/export/csv', [AssetController::class, 'exportCsv'])->name('assets.export.csv');
    Route::get('assets/import/template', [AssetController::class, 'downloadTemplate'])->name('assets.import.template');
    Route::post('assets/import/csv', [AssetController::class, 'importCsv'])->name('assets.import.csv');
    Route::post('assets/{asset}/maintenance', [AssetController::class, 'storeMaintenance'])->name('assets.maintenance.store');
    Route::post('assets/{asset}/attachments', [AssetController::class, 'storeAttachment'])->name('assets.attachments.store');
    Route::post('assets/{asset}/attachments/{attachment}/delete', [AssetController::class, 'destroyAttachment'])->name('assets.attachments.destroy');

    Route::resource('employees', EmployeeController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('categories', AssetCategoryController::class);
<<<<<<< HEAD
=======
    Route::get('digital-assets/expiring', [DigitalAssetController::class, 'expiring'])->name('digital-assets.expiring');
    Route::post('digital-assets/{digital_asset}/assign', [DigitalAssetController::class, 'assign'])->name('digital-assets.assign');
    Route::delete('digital-assets/{digital_asset}/assignments/{assignment}', [DigitalAssetController::class, 'unassign'])->name('digital-assets.unassign');
    Route::resource('digital-assets', DigitalAssetController::class)->parameters(['digital-assets' => 'digital_asset']);
    Route::get('find-assets', [AssetFinderController::class, 'index'])->name('find-assets.index');
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/{type}', [ReportController::class, 'show'])->name('reports.show');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});

require __DIR__.'/auth.php';
