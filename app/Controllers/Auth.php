<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login', [
            'config' => config('Auth'),
        ]);
    }

    public function register()
    {
        return view('auth/register');
    }

    public function activation()
    {
        return view('auth/emails/activation');
    }

    public function forgot_password()
    {
        return view('auth/forgot_password');
    }

    public function reset_password()
    {
        return view('auth/reset_password');
    }
}
