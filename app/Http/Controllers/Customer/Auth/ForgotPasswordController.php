<?php

namespace App\Http\Controllers\Customer\Auth;

use Illuminate\Support\Facades\Password;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:web');
    }

    protected function broker()
    {
        return Password::broker('users');
    }

    public function showLinkRequestForm()
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

        return view('front.auth.email',compact('meta_title','meta_description','meta_keyword'));
    }
}
