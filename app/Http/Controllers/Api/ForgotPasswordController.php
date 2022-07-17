<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApiCustomerForgetPassword;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{
    public function getForgetEmail(Request $request)
    {
        $email = $request->email;
        $customer = Customer::where('email',$email)->first();
        if(isset($customer))
        {
            $customer->forgot_password_otp = rand(100000, 999999);
            $customer->save();

            Mail::to($customer->email)->send(new ApiCustomerForgetPassword($customer->forgot_password_otp));

            return response()->json([
                'status' => 'true',
                'status_message' => 'OTP Sent To Email',
            ],200);
        }
        else
        {
            return response()->json([
                'status' => 'false',
                'status_message' => 'Email does not exist',
            ],200);
        }
    }

    public function resetPassword(Request $request)
    {
        $email = $request->email;
        $inputOTP = $request->otp;
        $password = $request->new_password;
        $confirmPassword = $request->confirm_password;

        //Validation

        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'new_password' => 'required_with:confirm_password|same:confirm_password',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $customer = Customer::where('email',$email)->first();
        if(isset($customer))
        {
            //Verify OTP
            if($inputOTP == $customer->forgot_password_otp)
            {
                //OTP Match
                $customer->password = Hash::make($password);
                $customer->save();
                return response()->json([
                    'status' => 'true',
                    'status_message' => 'Password Reset Success',
                ],200);
            }
            else
            {
                return response()->json([
                    'status' => 'false',
                    'status_message' => 'Invalid OTP',
                ],200);
            }
        }

        return response()->json([
            'status' => 'false',
            'status_message' => 'Invalid Email',
        ],200);

    }
}
