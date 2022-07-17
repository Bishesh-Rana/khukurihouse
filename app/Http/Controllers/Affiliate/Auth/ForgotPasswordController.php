<?php

namespace App\Http\Controllers\Affiliate\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:affiliate');
    }

    protected function broker()
    {
        return Password::broker('affiliates');
    }

    protected function checkAffiliateRequest(Request $request) //this function is clone of sendResetLinkEmail() in SendsPasswordResetEmails Trait
    {
        $statusCheck = Affiliate::where('email',$request->email)->first();

        if(!isset($statusCheck))
        {
            return back()->with('error','Invalid Email');
        }
        if($statusCheck->publish_status == '0'){
            return back()->with('error','Affiliate account not activated! Please contact '.config('app.name').' for Activation!');
        }
        if($statusCheck->delete_status == '1'){
            return back()->with('error','Affiliate account not found!');
        }

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);

    }

    public function showLinkRequestForm()
    {
        return view('affiliate.auth.email');
    }


}
