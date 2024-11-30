<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
    public function create(): View
    {
        return view('backend.auth.forgot-password');
    }


    public function passwordForm($token): View
    {
        return view('backend.auth.rocover-password');
    }
}
