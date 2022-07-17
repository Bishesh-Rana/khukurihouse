<?php

namespace App\Http\Controllers\Affiliate\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/ns-affiliate';

    public function __construct()
    {
        $this->middleware('guest:affiliate');
    }

    protected function guard()
    {
        return Auth::guard('affiliate');
    }

    protected function broker()
    {
        return Password::broker('affiliates');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('affiliate.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
