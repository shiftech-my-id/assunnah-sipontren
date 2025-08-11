<?php

namespace Modules\Ppdb\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return inertia('Index');
    }
}
