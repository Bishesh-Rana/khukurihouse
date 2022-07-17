<?php

namespace App\Http\Controllers\Admin\Auth;

// use Auth;
// use Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/ns-admin';

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function broker()
    {
        return Password::broker('admins');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
//This is testing
