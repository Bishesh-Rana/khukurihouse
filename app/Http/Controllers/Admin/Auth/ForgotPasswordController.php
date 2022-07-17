<?php

namespace App\Http\Controllers\Admin\Auth;

// use Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function broker()
    {
        return Password::broker('admins');
    }

    public function showLinkRequestForm()
    {
        return view('admin.auth.email');
    }
}
