<?php

namespace App\Http\Controllers\Delivery\Auth;

use Illuminate\Support\Facades\Auth;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:delivery')->except('logout');
    }

    public function showLoginForm()
    {
        return view('delivery.auth.delivery-login');
    }

    public function login(Request $request)
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

        //valid the form data
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        //Attempt to log the user in
        if(Auth::guard('delivery')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            //if success then redirect to location
            return redirect()->intended(route('delivery.dashboard'));
            // return redirect()->intended(route('delivery.index'));
        }
        //if unsuccessful then return back to login
        return back()->withInput($request->only('email','remember'))->with('error','Email and Password do not match');
    }

    public function logout()
    {
        Auth::guard('delivery')->logout();
        return redirect('ns-delivery/login');
    }
}
