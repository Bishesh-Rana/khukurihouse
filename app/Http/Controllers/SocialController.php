<?php

namespace App\Http\Controllers;

// use App\Models\User;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    //
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $isUser = Customer::where('fb_id', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect()->route('home.index');
            }else{
                $createUser = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'is_social_login' => 1,
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($createUser);
                return redirect()->route('home.index');;
            }

        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = Customer::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->route('home.index');

            }else{
                $newUser = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);

                return redirect()->route('home.index');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
