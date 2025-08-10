<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class ModulesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $modulesPath = base_path('modules');

        // Scan semua folder modul
        foreach (File::directories($modulesPath) as $modulePath) {
            $moduleName = basename($modulePath);

            // Web Routes
            $webRouteFile = $modulePath . '/Routes/web.php';
            if (File::exists($webRouteFile)) {
                Route::middleware('web')
                    ->prefix(strtolower($moduleName))
                    ->group($webRouteFile);
            }

            // API Routes
            $apiRouteFile = $modulePath . '/Routes/api.php';
            if (File::exists($apiRouteFile)) {
                Route::middleware('api')
                    ->prefix('api/' . strtolower($moduleName))
                    ->group($apiRouteFile);
            }
        }
    }
}
