<?php

namespace App\Http\Controllers\Delivery\Auth;

use App\Models\Delivery;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:delivery');
    }

    protected function broker()
    {
        return Password::broker('deliveries');
    }

    protected function checkDeliveryRequest(Request $request) //this function is clone of sendResetLinkEmail() in SendsPasswordResetEmails Trait
    {
        $statusCheck = Delivery::where('email',$request->email)->first();

        if(!isset($statusCheck))
        {
            return back()->with('error','Invalid Email');
        }
        if($statusCheck->publish_status == '0'){
            return back()->with('error','Delivery account not activated! Please contact '.config('app.name').' for Activation!');
        }
        if($statusCheck->delete_status == '1'){
            return back()->with('error','Delivery account not found!');
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
        return view('delivery.auth.email');
    }
}
