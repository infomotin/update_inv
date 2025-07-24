<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\WareHouseController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    // Route::get('/admin/change/password', [AdminController::class, 'ChangePassword'])->name('admin.change.password');
    // Route::post('/admin/update/password', [AdminController::class, 'UpdatePassword'])->name('admin.update.password');
});
//BrandController
Route::middleware('auth')->group(function () {
    Route::controller(BrandController::class)->group(function () {
        Route::get('/admin/brand/view', 'AdminBrandView')->name('admin.brands.index');
        Route::get('/admin/brand/create', 'AdminBrandCreate')->name('admin.brands.create');
        Route::post('/admin/brand/store', 'AdminBrandStore')->name('admin.brands.store');
        // Route::get('/admin/brand/edit/{id}', 'AdminBrandEdit')->name('admin.brands.edit');
        Route::post('/admin/brand/update/{id}', 'AdminBrandUpdate')->name('admin.brands.update');
        Route::delete('/admin/brand/destroy/{id}', 'AdminBrandDestroy')->name('admin.brands.destroy');
    });
});

//WareHouseController
Route::middleware('auth')->group(function () {
    Route::controller(WareHouseController::class)->group(function () {
        Route::get('/admin/warehouse/view', 'AdminWareHouseView')->name('admin.warehouses.index');
        // Route::get('/admin/warehouse/create', 'AdminWareHouseCreate')->name('admin.warehouses.create');
        Route::post('/admin/warehouse/store', 'AdminWareHouseStore')->name('admin.warehouses.store');
        // // Route::get('/admin/warehouse/edit/{id}', 'AdminWareHouseEdit')->name('admin.warehouses.edit');
        Route::post('/admin/warehouse/update/{id}', 'AdminWareHouseUpdate')->name('admin.warehouses.update');
        Route::delete('/admin/warehouse/destroy/{id}', 'AdminWareHouseDestroy')->name('admin.warehouses.destroy');
    });
});

require __DIR__ . '/auth.php';
Route::get('/admin/logout', [AdminController::class, 'Adminlogout'])->name('admin.logout');
