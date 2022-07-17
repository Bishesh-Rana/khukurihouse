<?php

namespace App\Http\Controllers\Customer\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
// use App\Mail\CustomerConfirmation;
use App\Http\Traits\MessageOtpTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SocialLoginMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CustomerLoginController extends Controller
{
    use MessageOtpTrait;

    protected $redirectTo = '/dashboard';
    protected $count = 0;

    public function __construct()
    {
        $this->middleware('guest:web')->except('accountlogout');
    }

    // public function showRegisterForm()
    // {
    //     return view('website.auth.signup');
    // }

    public function register(Request $request, Customer $customer)
    {
        $setting = Setting::first();
        //validate the form
        $this->validate(request(), [
            'name' => 'required|regex: /^[a-zA-Z]+(?:\s[a-zA-Z]+)+$/',
            // 'username' => 'required',
            // 'address' => 'required',
            'phone' => 'required|unique:tbl_customers|max:20',
            'email' => 'required|unique:tbl_customers|max:255',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
            // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
        ]);

        //create and save category
        $customer = new Customer();

        $customer->reward_point = $setting->register_reward;
        $customer->name = request('name');
        // $customer->username = request('username');
        $customer->phone = request('phone');
        $customer->email = request('email');
        $customer->address = request('address');
        $customer->password = Hash::make($request->password);
        $customer->verify_token = Str::random(25);
        $customer->verify_otp = rand(100000, 999999);

        $file = request()->file('photo');

        if ($file != null) {

            $image_name = "customer-" . time() . "." . $file->clientExtension();

            // open an image file
            $img = Image::make($file);

            // save image in desired format
            $img->save('uploads/' . 'customers/' . $image_name);

            $customer->image = $image_name;
        }


        $message = "Your OTP for " . config('app.name') . " User Registration is :" . $customer->verify_otp;
        $this->sendSMS($customer->phone, $customer->name, $message);
        // Mail::to($customer->email)->send(new CustomerConfirmation($customer));

        $customer->save();
        //redirect to dashboard
        // return back()->with('success', 'We have mailed you verification link.');

        //redirect to OTP Page
        // $setting = Setting::first();
        if ($setting != null) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }

        $status = 'We have sent the code to your number!';

        // session()->put('success', 'We have sent you the code!');
        // session()->forget('error');

        return view('website.auth.otp', compact('status', 'customer', 'meta_title', 'meta_description', 'meta_keyword'));
        // return redirect('/otp')->with('success','We have mailed you a 4 digit OTP.');
    }

    public function resendOTP($id)
    {
        $customer = Customer::where('id', $id)->first();
        $customer->verify_otp = rand(100000, 999999);
        $customer->save();

        $message = "Your OTP for " . config('app.name') . " User Registration is :" . $customer->verify_otp;
        $this->sendSMS($customer->phone, $customer->name, $message);
        // Mail::to($customer)->send(new CustomerConfirmation($customer));

        //redirect to OTP Page
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

        // session()->put('success', 'We have resent you the code. Please check your email.');
        // session()->forget('error');

        $status = 'We have resent the code to your number!';

        // return redirect('/otp')->with(compact('customer'));

        // return View::make('website.auth.otp')->with(compact('customer'))->with(compact('meta_title'))->with(compact('meta_description'))->with(compact('meta_keyword'))->with('success', 'Hello');
        return view('website.auth.otp', compact('status', 'customer', 'meta_title', 'meta_description', 'meta_keyword'));
    }

    public function verification(Request $request)
    {
        // session()->forget('success');
        //fetch customer by otp
        $customer = Customer::where('verify_otp', $request->otp)->first();

        //Update valid customer
        if (isset($customer)) {
            DB::table('tbl_customers')
                ->where('verify_otp', $customer->verify_otp)
                ->update(['email_verified_at' => Carbon::now()->toDateTimeString()]);
            return redirect()->intended(route('customer.login'))->with('success', 'Your email is verified. Please Log in to continue.');
        } else {

            $this->count = $this->count + 1;

            if ($this->count > 3) {
                return redirect('/resend/' . $customer->id)->with('error', 'We have sent you the code again. Please check your email.');
            }
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
            $customer = Customer::where('id', $request->customer_id)->first();
            // session()->put('error', 'Email could not be verified');
            $status = 'Invalid OTP! Email could not be verified!';
            return view('website.auth.otp', compact('status', 'customer', 'meta_title', 'meta_description', 'meta_keyword'));
        }
    }

    public function showLoginForm()
    {
        session()->forget('error');
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

        return view('front.auth.login', compact('meta_title', 'meta_description', 'meta_keyword'));
    }

    public function showRegisterForm()
    {
        session()->forget('error');
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

        return view('front.auth.register', compact('meta_title', 'meta_description', 'meta_keyword'));
    }

    public function showOTPForm()
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

        return view('website.auth.otp', compact('meta_title', 'meta_description', 'meta_keyword'));
    }

    public function login(Request $request)
    {
        //valid the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //if success then redirect to location
        $check = Customer::where('email', $request->email)->first();

        if ($check == null) {
            return back()->with('login-error', 'Email does not exist!');
        }

        //if email verified or not
        if (isset($check->email_verified_at)) {

            //Attempt to log the customer in
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                //if successful then redirect to dashboard
                return redirect()->intended(route('customer.dashboard'));
            }
            //if unsuccessful then return back to login
            return back()->with('login-error', 'Email and Password do not match')->withInput($request->only('email', 'remember'));
        }
        else {

            //if the customer have not verified their email
            return redirect()->route('customer.otp', $check->id)->with('login-error', 'Please verify your email first');
        }
    }

    public function redirectToProvider($provider)
    {
        // dd($provider);
        return Socialite::driver($provider)->redirect();
        // return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        $setting = Setting::first();

        if (!$request->has('code') || $request->has('denied')) {
            return redirect('/');
        }
        $apiuser = Socialite::driver($provider)->user();

        // $apiuser = Socialite::driver('github')->user();
        // dd($apiuser->getId());

        $user = Customer::where('email', $apiuser->getEmail())->first();
        $dummy_password = '12345678';

        if (!$user) {
            //add user to database
            $user = Customer::create([
                'email' => $apiuser->getEmail(),
                'name' => $apiuser->getName(),
                'password' => Hash::make($dummy_password),
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'provider_id' => $apiuser->getId(),
                'reward_point' => $setting->register_reward
            ]);
            Mail::to($apiuser->getEmail())->send(new SocialLoginMail($dummy_password));
        }

        //log user in
        Auth::login($user, true);

        return redirect($this->redirectTo);
    }

    public function accountlogout()
    {
        // dd('waot');
        Auth::guard('web')->logout();
        return redirect('/signin');
    }
}
