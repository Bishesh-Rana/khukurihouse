<?php

namespace App\Http\Controllers;

// use App\Mail\SellerRegisterConfirmation;
use App\Mail\SellerRegisterSuccess;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\MessageOtpTrait;
use Illuminate\Support\Str;

class SellerRegisterController extends Controller
{
    use MessageOtpTrait;

    // public function __construct()
    // {
    //     $this->middleware('guest:seller')->except('accountlogout');
    // }

    public function showRegisterForm()
    {
        return view('website.auth.seller.signup');
    }

    public function register(Request $request)
    {
        //validate the form
        $this->validate(request(), [
            'first_name' => 'required|min:3|alpha',
            'last_name' => 'required|min:3|alpha',
            'company_name' => 'required|unique:tbl_sellers',
            'company_address' => 'required',
            'company_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:15|unique:tbl_sellers',
            'email' => 'required|email|unique:tbl_sellers',
            // 'username' => 'required|unique:tbl_sellers',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
        ]);

        //create and save category
        $seller = new Seller();

        $seller->first_name = request('first_name');
        $seller->middle_name = request('middle_name');
        $seller->last_name = request('last_name');
        $seller->company_name = request('company_name');
        $seller->company_address = request('company_address');
        $seller->company_phone = request('company_phone');
        $seller->email = request('email');
        // $seller->username = request('username');
        $seller->seller_code = Str::slug(request('company_name')) . '-' . Str::random(6);
        $seller->password = Hash::make($request->password);
        $seller->verify_otp = rand(100000, 999999);


        $message = "Your OTP for ".config('app.name')." Seller Registration is :".$seller->verify_otp;
        $this->sendSMS($seller->company_phone,$seller->company_name,$message);
        // Mail::to($seller->email)->send(new SellerRegisterConfirmation($seller));

        $seller->save();

        //redirect to OTP Page
        return redirect()->route('seller.otp', $seller->seller_code);
    }

    public function showOTPForm(Request $request, $seller_code)
    {
        $seller = Seller::where('seller_code', $seller_code)->firstOrFail();

        if ($request->invalid == "1") { //Invalid OTP
            $status = 'Invalid OTP! Please check your email.';

        } else if ($request->resend == "1") { // Resend OTP
            $seller->verify_otp = rand(100000, 999999);

            $message = "Your OTP for ".config('app.name')." Seller Registration is :".$seller->verify_otp;
            $this->sendSMS($seller->company_phone,$seller->company_name,$message);
            // Mail::to($seller->email)->send(new SellerRegisterConfirmation($seller));
            $seller->save();

            $status = 'We have resent you the code again!';

        } else { // First Time OTP
            $status = 'We have sent you the code!';
        }

        return view('website.auth.seller.otp', compact('status', 'seller'));
    }

    public function verification(Request $request)
    {
        $seller = Seller::where('id', $request->seller_id)->first();

        if ($seller->verify_otp == $request->otp) {

            // $seller->publish_status = "1";
            // $seller->save();

            Mail::to($seller->email)->send(new SellerRegisterSuccess());
            return redirect()->route('seller.success');

        } else {
            return redirect()->route('seller.otp', [$seller->seller_code, 'invalid' => '1']);
        }
    }

    public function success()
    {
        return view('website.auth.seller.success');
    }
}
