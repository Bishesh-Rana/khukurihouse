<?php

namespace App\Http\Controllers\Customer\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\Setting;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:web');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    protected function broker()
    {
        return Password::broker('users');
    }

    public function showResetForm(Request $request, $token = null)
    {
        $setting = Setting::first();
        if ($setting != null) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }

        return view('front.auth.reset')->with(
            ['token' => $token,
            'email' => $request->email,
            'meta_title' => $meta_title ,
            'meta_description' => $meta_description,
            'meta_keyword' => $meta_keyword
            ]
        );
    }
}
