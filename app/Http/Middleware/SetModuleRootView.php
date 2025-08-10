<?php

// App/Http/Middleware/SetModuleRootView.php
namespace App\Http\Middleware;

use Closure;
use Inertia\Inertia;

class SetModuleRootView
{
    public function handle($request, Closure $next)
    {
        $firstSegment = strtolower($request->segment(1) ?? 'app');

        $viewFile = resource_path("views/modules/{$firstSegment}.blade.php");
        if (file_exists($viewFile)) {
            Inertia::setRootView("modules.{$firstSegment}");
            Inertia::share('currentModule', $firstSegment);
        } else {
            Inertia::share('currentModule', 'app');
        }

        return $next($request);
    }
}
