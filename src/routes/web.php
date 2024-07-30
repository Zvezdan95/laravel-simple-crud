<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\UserIsActive;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminPanelController::class, 'index'])->middleware(UserIsActive::class)->name('admin');

Route::middleware(UserIsActive::class)->group(function () {
    Route::get('/admin/address/{userId}/{id?}',[AddressController::class, 'index'])->name('address');
    Route::post('/admin/address/{id?}',[AddressController::class, 'upsert'])->name('address.upsert');
    Route::delete('/admin/address/delete',[AddressController::class, 'delete'])->name('address.delete');
    Route::post('/admin/change-user-status', [AdminPanelController::class, 'changeUserStatus'])->name('admin.deleteUser');
    Route::post('/admin/delete-user', [AdminPanelController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
