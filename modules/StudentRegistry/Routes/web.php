<?php

use Illuminate\Support\Facades\Route;
use Modules\StudentRegistry\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('student-registry.index');
