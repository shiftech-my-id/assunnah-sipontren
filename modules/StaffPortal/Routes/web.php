<?php

use App\Http\Middleware\StaffAuth;
use Illuminate\Support\Facades\Route;
use Modules\StaffPortal\Http\Controllers\AuthController;
use Modules\StaffPortal\Http\Controllers\IndexController;
use Modules\StaffPortal\Http\Controllers\ProfileController;

Route::match(['GET', 'POST'], '/login', [AuthController::class, 'login'])->name('staff-portal.auth.login');

Route::middleware([StaffAuth::class])->group(function () {
    Route::get('', [IndexController::class, 'index'])->name('staff-portal.index');
    Route::post('logout', [AuthController::class, 'logout'])->name('staff-portal.auth.logout');

    Route::get('profile', [ProfileController::class, 'index'])->name('staff-portal.profile.index');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('staff-portal.profile.update');
    Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('staff-portal.profile.update-password');
});
