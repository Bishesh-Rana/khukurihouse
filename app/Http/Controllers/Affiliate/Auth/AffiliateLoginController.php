<?php

namespace App\Http\Controllers\Affiliate\Auth;

use Illuminate\Support\Facades\Auth;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AffiliateLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:affiliate')->except('logout');
    }

    public function showLoginForm()
    {
        return view('affiliate.auth.affiliate-login');
    }

    public function login(Request $request)
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

        //valid the form data
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        //Attempt to log the user in
        if(Auth::guard('affiliate')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            //if success then redirect to location
            return redirect()->intended(route('affiliate.dashboard'));
            // return redirect()->intended(route('affiliate.index'));
        }
        //if unsuccessful then return back to login
        return back()->withInput($request->only('email','remember'))->with('error','Email and Password do not match');
    }

    public function logout()
    {
        Auth::guard('affiliate')->logout();
        return redirect('ns-affiliate/login');
    }
}
