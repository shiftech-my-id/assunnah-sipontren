<?php

use Illuminate\Support\Facades\Route;
use Modules\StaffPortal\Http\Controllers\AuthController;
use Modules\StaffPortal\Http\Controllers\IndexController;
use Modules\StaffPortal\Http\Controllers\ProfileController;

Route::get('/', [IndexController::class, 'index'])->name('staff-portal.index');

Route::match(['GET', 'POST'], '/login', [AuthController::class, 'login'])->name('staff-portal.auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('staff-portal.auth.logout');

Route::get('/profile', [ProfileController::class, 'index'])->name('staff-portal.profile.index');
