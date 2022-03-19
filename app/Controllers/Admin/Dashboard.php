<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->is_logged) {
            return redirect()->route('login');
        }
        return view('dashboard/index');
    }
}
