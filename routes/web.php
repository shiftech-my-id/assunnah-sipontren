<?php


use App\Http\Middleware\Auth;
use App\Http\Middleware\NonAuthenticated;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage-new');
})->name('home');

Route::get('/test', function () {
    return inertia('Test');
})->name('test');

Route::get('/_cmd/clear-all-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return 'Cache cleared';
});

Route::middleware(NonAuthenticated::class)->group(function () {
    // Route::redirect('/', 'admin/auth/login', 301);
    // Route::prefix('/admin/auth')->group(function () {
    //     Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('admin.auth.login');
    //     Route::match(['get', 'post'], 'register', [AuthController::class, 'register'])->name('admin.auth.register');
    //     Route::match(['get', 'post'], 'forgot-password', [AuthController::class, 'forgotPassword'])->name('admin.auth.forgot-password');
    // });
});

Route::middleware([Auth::class])->group(function () {
    // Route::match(['get', 'post'], 'admin/auth/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');

    Route::prefix('admin')->group(function () {
        Route::redirect('', 'admin/dashboard', 301);

        // Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Route::prefix('reports')->group(function () {
        //     Route::get('', [ReportController::class, 'index'])->name('admin.report.index');

        //     Route::get('demo-plot-detail', [ReportController::class, 'demoPlotDetail'])->name('admin.report.demo-plot-detail');
        //     Route::get('new-demo-plot-detail', [ReportController::class, 'newDemoPlotDetail'])->name('admin.report.new-demo-plot-detail');
        //     Route::get('demo-plot-with-photo', [ReportController::class, 'demoPlotWithPhoto'])->name('admin.report.demo-plot-with-photo');
        //     Route::get('activity-plan-detail', [ReportController::class, 'activityPlanDetail'])->name('admin.report.activity-plan-detail');
        //     Route::get('activity-realization-detail', [ReportController::class, 'activityRealizationDetail'])->name('admin.report.activity-realization-detail');
        //     Route::get('activity-target-detail', [ReportController::class, 'activiyTargetDetail'])->name('admin.report.activity-target-detail');
        // });

        // Route::prefix('settings')->group(function () {
        //     Route::get('profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        //     Route::post('profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
        //     Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('admin.profile.update-password');

        //     Route::get('company-profile/edit', [CompanyProfileController::class, 'edit'])->name('admin.company-profile.edit');
        //     Route::post('company-profile/update', [CompanyProfileController::class, 'update'])->name('admin.company-profile.update');

        //     Route::prefix('users')->middleware(['auto-permission'])->group(function () {
        //         Route::get('', [UserController::class, 'index'])->name('admin.user.index');
        //         Route::get('data', [UserController::class, 'data'])->name('admin.user.data');
        //         Route::get('add', [UserController::class, 'editor'])->name('admin.user.add');
        //         Route::get('edit/{id}', [UserController::class, 'editor'])->name('admin.user.edit');
        //         Route::get('duplicate/{id}', [UserController::class, 'duplicate'])->name('admin.user.duplicate');
        //         Route::post('save', [UserController::class, 'save'])->name('admin.user.save');
        //         Route::post('delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
        //         Route::get('detail/{id}', [UserController::class, 'detail'])->name('admin.user.detail');
        //         Route::get('export', [UserController::class, 'export'])->name('admin.user.export');
        //     });

        //     Route::get('database', [DatabaseController::class, 'index'])->name('admin.db.index');
        //     Route::get('database/backup', [DatabaseController::class, 'backup'])->name('admin.db.backup');
        //     Route::get('db/restore', [DatabaseController::class, 'restore'])->name('admin.db.restore');
        // });
    });
});
