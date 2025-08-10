<?php

use Illuminate\Support\Facades\Route;
use Modules\AuthInternal\Http\Controllers\AuthController;

Route::match(['GET', 'POST'], '/login', [AuthController::class, 'login'])->name('auth-internal.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth-internal.logout');
