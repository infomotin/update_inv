<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BrandController;

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
    });
});
require __DIR__ . '/auth.php';
Route::get('/admin/logout', [AdminController::class, 'Adminlogout'])->name('admin.logout');
