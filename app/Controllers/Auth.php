<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        return view("auth/login");
    }

    public function recoverPassword()
    {
        return view("auth/recoverpassword");
    }
}