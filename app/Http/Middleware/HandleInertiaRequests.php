<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    public function rootView(Request $request)
    {
        $module_root_view = $request->attributes->get('module_root_view', null);
        if (!$module_root_view) return $this->rootView;
        return "modules/" . $module_root_view . '/app';
    }

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user(); // ganti jadi dummy user dulu dong!
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user ? [
                    'id' => $user->id,
                    'company_name' => Setting::value('company_name', 'My Company'),
                    'name' => $user->name,
                    'username' => $user->username,
                    'is_root' => $user->is_root,
                    'role' => $user->role,
                    'email' => $user->email,
                ] : null,
                'permissions' => fn() => config('roles.' . optional($request->user())->role, []),
            ],
            'flash' => [
                'info' => $request->session()->get('message'),
                'success' => $request->session()->get('success'),
                'warning' => $request->session()->get('warning'),
                'error' => $request->session()->get('error')
            ],
        ];
    }
}
