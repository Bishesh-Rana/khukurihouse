<?php

namespace App\Http\Controllers\Customer\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Mail\CustomerConfirmation;
use App\Http\Controllers\Controller;

class CustomerRegisterController extends Controller
{
    public function register(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|regex: /^[a-zA-Z]+(?:\s[a-zA-Z]+)+$/',
            'address' => 'required',
            'phone' => 'required|unique:tbl_customers|max:20',
            'email' => 'required|unique:tbl_customers|max:255',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
        ]);

        $customer = new Customer();

        $customer->reward_point = Setting::first()->register_reward;
        $customer->name = request('name');
        // $customer->username = Str::slug(request('name')).'-'.rand(10000, 99999);
        $customer->phone = request('phone');
        $customer->email = request('email');
        $customer->address = request('address');
        $customer->password = Hash::make($request->password);
        $customer->verify_token = Str::random(25);
        $customer->verify_otp = rand(100000, 999999);
        $customer->title = request('other_title') ?? request('title');


        $message = "Your OTP for " . config('app.name') . " User Registration is :" . $customer->verify_otp;
        // $this->sendSMS($customer->phone, $customer->name, $message);
        Mail::to($customer->email)->send(new CustomerConfirmation($customer));

        $customer->save();

        //redirect to OTP Page
        return redirect()->route('customer.otp', $customer->id);
        // return redirect()->route('customer.login')->with('success','Register successfully.');

        // return view('website.auth.otp', compact('status', 'customer', 'meta_title', 'meta_description', 'meta_keyword'));
        // return redirect('/otp')->with('success','We have mailed you a 4 digit OTP.');
    }

    public function showOTPForm($id, Request $request)
    {
        $customer = Customer::where('id', $id)->firstOrFail();

        if ($request->invalid == "1") { //Invalid OTP
            $status = 'Invalid OTP! Please check your message.';
        } else if ($request->resend == "1") { // Resend OTP
            $customer->verify_otp = rand(100000, 999999);

            // $message = "Your OTP for ".config('app.name')." Customer Registration is :".$customer->verify_otp;
            // $this->sendSMS($customer->company_phone,$customer->company_name,$message);
            Mail::to($customer->email)->send(new CustomerConfirmation($customer));
            $customer->save();

            $status = 'We have resent you the code again in your email!';
        } else { // First Time OTP
            $status = 'We have sent you the code in your email!';
        }

        return view('front.auth.otp', compact('status', 'customer'));
    }

    public function verification(Request $request)
    {
        $customer = Customer::where('email', $request->email)->firstOrFail();

        if ($customer->verify_otp == $request->otp) {

           Customer::where('verify_otp', $customer->verify_otp)->update(['email_verified_at' => Carbon::now()]);

           return redirect()->intended(route('customer.login'))->with('success', 'Your email has been verified. Please Log in to continue.');

        } else {
            return redirect()->route('customer.otp', [$customer->id, 'invalid' => '1'])->with('error-message', 'Email cannot be verified.');
        }
    }
}
