<?php

namespace App\Http\Controllers\Api;

use App\Models\Referral;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Customer;
use App\Mail\CustomerConfirmation;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\SocialLoginMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\MessageOtpTrait;

class LoginController extends Controller
{
    use MessageOtpTrait;

    public function calculateRewardPointFromRefer($id)
    {
        $setting = Setting::first();
        $customer = Customer::where('id', $id)->first();
        if (isset($customer)) {
            $current_reward = $customer->reward_point;
            $refer_reward = $setting->refer_reward;
            $final_reward = $current_reward + $refer_reward;

            $data = ([
                'reward_point' => $final_reward,
            ]);

            Customer::where('id', $id)->update($data);
        }
        return true;
    }

    public function register(Request $request, Customer $customer)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'username' => 'required|unique:tbl_customers',
            'address' => 'required',
            // 'country' => 'required',
            // 'state' => 'required',
            // 'town' => 'required',
            // 'street' => 'required',
            // 'zipcode' => 'required',
            'phone' => 'required|unique:tbl_customers|max:20',
            'email' => 'required|unique:tbl_customers|max:255',
            'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8',
            // 'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
        ]);


        if ($validator->fails()) {
            return response()->json([
                $validator->messages(),
                'status' => false,
                'status_message' => 'validation error !!!'
            ], 200);
        }

        //create and save category
        // return $request->refer_code;
        $customer = new Customer();
        $code = $request->refer_code;
        if (isset($code)) {
            $referal_id = Referral::where('referral_code', $code)->first()->customer_id;
            $customer->referal_id = $referal_id;
            $this->calculateRewardPointFromRefer($referal_id);
        }

        $setting = Setting::first();

        $customer->name = request('name');
        $customer->reward_point = $setting->register_reward;
        // $customer->username = request('username');
        $customer->phone = request('phone');
        $customer->email = request('email');
        $customer->address = request('address');
        $customer->password = Hash::make($request->password);
        // $customer->token = str_random(25);
        // $customer->country = request('country');
        // $customer->state = request('state');
        // $customer->town = request('town');
        // $customer->street = request('street');
        // $customer->apartment = request('apartment');
        // $customer->zipcode = request('zipcode');
        $customer->verify_otp = rand(100000, 999999);
        $customer->is_social_login = '1';

        $customer->save();

        $message = "Your OTP for " . config('app.name') . " User Registration is :" . $customer->verify_otp;
        $this->sendSMS($customer->phone, $customer->name, $message);
        // Mail::to($customer->email)->send(new CustomerConfirmation($customer));

        // \Mail::to($customer)->send(new CustomerConfirmation($customer));
        //   return 'done';
        //redirect to dashboard

        $message = new Message();
        $message->owner_id = 0;
        $message->customer_id = $customer->id;
        $message->message = 'Thank You for registering with ' . config('app.name') . '. Feel Free to message us at any time.';
        $message->send_by = "seller";
        $message->save();

        return response()->json([
            'status' => true,
            'message' => "We have messaged you OTP code.",
            'data' => $customer->email
        ], 200);
    }

    public function resendOTP(Request $request)
    {
        $email = request('email');
        $customer = Customer::where('email', $email)->first();

        $customer->verify_otp = rand(100000, 999999);
        $customer->save();

        $message = "Your OTP for " . config('app.name') . " User Registration is :" . $customer->verify_otp;
        $this->sendSMS($customer->phone, $customer->name, $message);
        // Mail::to($customer->email)->send(new CustomerConfirmation($customer));

        return response()->json([
            'status' => true,
            'status_message' => "We have mailed you OTP code",
            'data' => $customer->email
        ], 200);
    }

    public function verification(Request $request)
    {
        //fetch customer by otp
        $customer = Customer::where('verify_otp', $request->otp)->first();

        //Update valid customer
        if (isset($customer)) {
            DB::table('tbl_customers')
                ->where('verify_otp', $customer->verify_otp)
                ->update(['email_verified_at' => Carbon::now()->toDateTimeString()]);

            return response()->json([
                'status' => true,
                'status_message' => "Your email is verified. Please Sign in to continue.",
            ], 200);
        } else {

            return response()->json([
                'status' => false,
                'status_message' => "You entered wrong OTP",
            ], 200);
        }
    }

    public function login(Request $request)
    {

        $check = Customer::where('email', $request->email)->first();

        if ($check == null) {
            return response()->json([
                'status' => false,
                'status_message' => "Invalid Email",
                'code' => '0'
            ], 200);
        }

        //if email verified or not
        if (!isset($check->email_verified_at)) {
            return response()->json([
                'status' => false,
                'status_message' => "Please verify your email first",
                'code' => '1'
            ], 200);
        }

        // $test = User::get();
        // return $test;
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        // dd(Auth::guard('web')->attempt($credentials));

        if (!Auth::attempt($credentials))
            return response()->json([
                'status' => false,
                'status_message' => 'Email or Password Doesn\'t Match'
            ], 200);

        $user = $request->user();

        // dd(Auth::guard('web')->user());
        // return $user;
        // print_r(Auth::guard('api')->login($credentials));
        // dd(Auth::check());
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'status' => true,
            'login_detail' => $user,
            'status_message' => 'Login Success!',
            'image_link' => asset('uploads/customers'),
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ])->header('Authorization', $tokenResult->accessToken);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $request->user()
        ]);
    }

    public function resetToken(Request $request)
    {
        try {
            //            Passport::personalAccessTokensExpireIn(now()->addMinutes(30));

            $user = Auth::user();
            $token = $user->token();
            $token->revoke();
            $tokenResult = $token = $user->createToken('Personal Access Token')->accessToken;
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $tokenResult);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function socialLogin(Request $request)
    {
        // return $request;
        $customer = Customer::where('email', $request->email)->first();
        $dummyPassword = rand(10000000, 99999999);

        if (isset($customer)) {
            //Reset Password
            $data = ([
                'password' => Hash::make($dummyPassword)
            ]);
            Customer::where('email', $request->email)->update($data);
            Mail::to($request->email)->send(new SocialLoginMail($dummyPassword));
        }

        $code = $request->refer_code;
        if (isset($code)) {
            $referal_id = Referral::where('referral_code', $code)->first()->customer_id;
            $this->calculateRewardPointFromRefer($referal_id);
        }

        if (!$customer) {
            //create and save customer
            // return $customer;
            $setting = Setting::first();
            $customer = Customer::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($dummyPassword),
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_social_login' => '1',
                'reward_point' => $setting->register_reward
            ]);


            Mail::to($request->email)->send(new SocialLoginMail($dummyPassword));

            $message = new Message();
            $message->owner_id = 0;
            $message->customer_id = $customer->id;
            $message->message = 'Thank You for registering with ' . config('app.name') . '. Feel Free to message us at any time.';
            $message->send_by = "seller";
            $message->save();
        }

        //Perform Login Operation
        $credentials = ([
            'email' => $customer->email,
            'password' => $dummyPassword,
        ]);

        if (!Auth::attempt($credentials))
            return response()->json([
                'status' => false,
                'status_message' => 'Email or Password Doesn\'t Match'
            ], 200);

        $user = $request->user();

        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'status' => true,
            'login_detail' => $user,
            'status_message' => 'Login Success!',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ])->header('Authorization', $tokenResult->accessToken);
    }
}
