<?php

use Illuminate\Support\Facades\Route;
use Modules\Ppdb\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('ppdb.index');
