<?php

namespace App\Http\Controllers\Delivery\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/ns-delivery';

    public function __construct()
    {
        $this->middleware('guest:delivery');
    }

    protected function guard()
    {
        return Auth::guard('delivery');
    }

    protected function broker()
    {
        return Password::broker('deliveries');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('delivery.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
