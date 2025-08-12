<?php

use App\Http\Middleware\StaffAuth;
use Illuminate\Support\Facades\Route;
use Modules\SysAdmin\Http\Controllers\IndexController;
use Modules\SysAdmin\Http\Controllers\UserController;

Route::middleware([StaffAuth::class])->group(function () {
    Route::redirect('', '/sys-admin/home')->name('sys-admin.index');
    Route::get('/home', [IndexController::class, 'index'])->name('sys-admin.home');

    Route::prefix('users')->middleware([])->group(function () {
        Route::get('', [UserController::class, 'index'])->name('sys-admin.user.index');
        Route::get('data', [UserController::class, 'data'])->name('sys-admin.user.data');
        Route::get('add', [UserController::class, 'editor'])->name('sys-admin.user.add');
        Route::get('edit/{id}', [UserController::class, 'editor'])->name('sys-admin.user.edit');
        Route::get('duplicate/{id}', [UserController::class, 'duplicate'])->name('sys-admin.user.duplicate');
        Route::post('save', [UserController::class, 'save'])->name('sys-admin.user.save');
        Route::post('delete/{id}', [UserController::class, 'delete'])->name('sys-admin.user.delete');
        Route::get('detail/{id}', [UserController::class, 'detail'])->name('sys-admin.user.detail');
        Route::get('export', [UserController::class, 'export'])->name('sys-admin.user.export');
    });
});
