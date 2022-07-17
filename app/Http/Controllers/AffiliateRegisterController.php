<?php

namespace App\Http\Controllers;

// use App\Mail\AffiliateRegisterConfirmation;
use App\Mail\AffiliateRegisterSuccess;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\MessageOtpTrait;

class AffiliateRegisterController extends Controller
{
    use MessageOtpTrait;

    // public function __construct()
    // {
    //     $this->middleware('guest:affiliate')->except('accountlogout'); //TODO
    // }

    public function showRegisterForm()
    {
        return view('website.auth.affiliate.signup');
    }

    public function register(Request $request)
    {
        //validate the form
        $this->validate(request(), [
            'first_name' => 'required|min:3|alpha',
            'last_name' => 'required|min:3|alpha',
            // 'company_name' => 'required|unique:tbl_affiliates',
            'address' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:15|unique:tbl_affiliates',
            'email' => 'required|email|unique:tbl_affiliates',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
        ]);

        //create and save category
        $affiliate = new Affiliate();

        $affiliate->first_name = request('first_name');
        $affiliate->middle_name = request('middle_name');
        $affiliate->last_name = request('last_name');
        // $affiliate->username = request('username');
        // $affiliate->company_name = request('company_name');
        $affiliate->address = request('address');
        $affiliate->phone = request('phone');
        $affiliate->email = request('email');
        $affiliate->affiliate_code = \Str::slug(request('first_name')) . '-' . rand(100000, 999999);
        $affiliate->password = Hash::make($request->password);
        $affiliate->verify_otp = rand(100000, 999999);

        $message = "Your OTP for ".config('app.name')." Affiliate Registration is :".$affiliate->verify_otp;
        $this->sendSMS($affiliate->phone,$affiliate->first_name,$message);
        // Mail::to($affiliate->email)->send(new AffiliateRegisterConfirmation($affiliate));

        $affiliate->save();

        //redirect to OTP Page
        return redirect()->route('affiliate.otp', $affiliate->affiliate_code);
    }

    public function showOTPForm(Request $request, $affiliate_code)
    {
        $affiliate = Affiliate::where('affiliate_code', $affiliate_code)->firstOrFail();

        if ($request->invalid == "1") { //Invalid OTP

            $status = 'Invalid OTP! Please check your email.';

        } else if ($request->resend == "1") { // Resend OTP

            $affiliate->verify_otp = rand(100000, 999999);

            $message = "Your OTP for ".config('app.name')." Affiliate Registration is :".$affiliate->verify_otp;
            $this->sendSMS($affiliate->phone,$affiliate->first_name,$message);
            // Mail::to($affiliate->email)->send(new AffiliateRegisterConfirmation($affiliate));
            $affiliate->save();

            $status = 'We have resent you the code again!';

        } else { // First Time OTP

            $status = 'We have sent you the code!';

        }

        return view('website.auth.affiliate.otp', compact('status', 'affiliate'));
    }

    public function verification(Request $request)
    {
        $affiliate = Affiliate::where('id', $request->affiliate_id)->first();

        if ($affiliate->verify_otp == $request->otp) {

            // $affiliate->publish_status = "1";
            // $affiliate->save();

            Mail::to($affiliate->email)->send(new AffiliateRegisterSuccess());
            return redirect()->route('affiliate.success');


        } else {
            return redirect()->route('affiliate.otp', [$affiliate->affiliate_code, 'invalid' => '1']);
        }
    }

    public function success()
    {
        return view('website.auth.affiliate.success');
    }
}
