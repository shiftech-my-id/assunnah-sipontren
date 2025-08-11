<?php

use Illuminate\Support\Facades\Route;
use Modules\SysAdmin\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('sys-admin.index');
