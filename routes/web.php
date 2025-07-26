<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\WareHouseController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\UnitController;

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
//SupplierController
Route::middleware('auth')->group(function () {
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/admin/supplier/view', 'AdminSupplierView')->name('admin.suppliers.index');
        Route::get('/admin/supplier/create', 'AdminSupplierCreate')->name('admin.suppliers.create');
        Route::post('/admin/supplier/store', 'AdminSupplierStore')->name('admin.suppliers.store');
        // Route::get('/admin/supplier/edit/{id}', 'AdminSupplierEdit')->name('admin.suppliers.edit');
        Route::post('/admin/supplier/update/{id}', 'AdminSupplierUpdate')->name('admin.suppliers.update');
        Route::delete('/admin/supplier/destroy/{id}', 'AdminSupplierDestroy')->name('admin.suppliers.destroy');
    });
});
//CustomerController
Route::middleware('auth')->group(function () {
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/admin/customer/view', 'AdminCustomerView')->name('admin.customers.index');
        Route::get('/admin/customer/create', 'AdminCustomerCreate')->name('admin.customers.create');
        Route::post('/admin/customer/store', 'AdminCustomerStore')->name('admin.customers.store');
        // Route::get('/admin/customer/edit/{id}', 'AdminCustomerEdit')->name('admin.customers.edit');
        Route::post('/admin/customer/update/{id}', 'AdminCustomerUpdate')->name('admin.customers.update');
        Route::delete('/admin/customer/destroy/{id}', 'AdminCustomerDestroy')->name('admin.customers.destroy');
    });
});
//CategoryController
Route::middleware('auth')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/category/view', 'AdminCategoryView')->name('admin.categories.index');
        Route::get('/admin/category/create', 'AdminCategoryCreate')->name('admin.categories.create');
        Route::post('/admin/category/store', 'AdminCategoryStore')->name('admin.categories.store');
        // Route::get('/admin/category/edit/{id}', 'AdminCategoryEdit')->name('admin.categories.edit');
        Route::post('/admin/category/update/{id}', 'AdminCategoryUpdate')->name('admin.categories.update');
        Route::delete('/admin/category/destroy/{id}', 'AdminCategoryDestroy')->name('admin.categories.destroy');
    });
});

//UnitController
Route::middleware('auth')->group(function () {
    Route::controller(UnitController::class)->group(function () {
        Route::get('/admin/unit/view', 'AdminUnitView')->name('admin.units.index');
        Route::get('/admin/unit/create', 'AdminUnitCreate')->name('admin.units.create');
        Route::post('/admin/unit/store', 'AdminUnitStore')->name('admin.units.store');
        // Route::get('/admin/unit/edit/{id}', 'AdminUnitEdit')->name('admin.units.edit');
        Route::post('/admin/unit/update/{id}', 'AdminUnitUpdate')->name('admin.units.update');
        Route::delete('/admin/unit/destroy/{id}', 'AdminUnitDestroy')->name('admin.units.destroy');
    });
});
require __DIR__ . '/auth.php';
Route::get('/admin/logout', [AdminController::class, 'Adminlogout'])->name('admin.logout');
