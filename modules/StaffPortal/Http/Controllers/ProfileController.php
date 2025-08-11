<?php

namespace Modules\StaffPortal\Http\Controllers;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return inertia('profile/Index');
    }
}
