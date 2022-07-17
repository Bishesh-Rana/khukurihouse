<?php

namespace App\Http\Controllers\Admin\Auth;

// use Auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.admin-login');
    }

    public function login(Request $request)
    {
        $statusCheck = Admin::where('email',$request->email)->first();
        if(!isset($statusCheck))
        {
            return back()->with('error','Invalid Email');
        }
        if($statusCheck->publish_status == '0'){
            return back()->with('error','Invalid Access');
        }
        if($statusCheck->delete_status == '1'){
            return back()->with('error','Invalid Access');
        }
        //valid the form data
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        //Attempt to log the user in
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            //if success then redirect to location
            return redirect()->intended(route('admin.dashboard'));
            // return redirect()->intended(route('admin.index'));
        }
        //if unsuccessful then return back to login
        return back()->withInput($request->only('email','remember'))->with('error','Email and Password do not match');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('ns-admin/login');
    }
}
