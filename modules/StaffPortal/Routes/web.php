<?php

use Illuminate\Support\Facades\Route;
use Modules\StaffPortal\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('staff-portal.index');
