<?php

namespace App\Http\Controllers\Delivery;

use Intervention\Image\Facades\Image;
use App\Models\Delivery;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:delivery');
    }

    public function show()
    {
        $delivery_profile_count_info = Delivery::where('delete_status', '0')->where('publish_status', '1')
            ->where('id', Auth::guard('delivery')->user()->id)
            ->select(
                'image',
                'first_name',
                'middle_name',
                'last_name',
                'company_name',
                'company_phone',
                'company_address',
                'email',
                'company_description',
                'company_country',
                'company_city',
                'company_state',
                'zip_code',
                'company_website',
                'bank_name',
                'bank_acc_number',
                'pan_no',
                'vat_no'
            )
            ->first();

        $profile_count = $delivery_profile_count_info->delivery_profile_information;

        $countries = DB::table('all_values')->select('all_values.*')->get();

        $delivery = Delivery::where('id', Auth::guard('delivery')->user()->id)->first();
        abort_if(!$delivery, 404);

        return view('delivery.pages.profile', compact('delivery', 'countries', 'profile_count'));
    }

    public function update(Request $request)
    {
        // dd($id);
        $id = Auth::guard('delivery')->user()->id;
        $delivery = Delivery::find($id);

        $this->validate(request(), [

            'first_name' => 'required',
            'last_name' => 'required',
            // 'username' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required',
            'password' => 'required_with:password_confirmation|same:password_confirmation',

        ]);

        $data = ([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            // 'username' => request('username'),
            'email' => request('email'),
        ]);


        $file = request()->file('image');

        if ($file != null) {

            //deleting previous image
            $image = $delivery->image;
            @unlink('uploads/deliveries/' . $image);

            $image_name = "delivery-" . time() . "." . $file->clientExtension();

            // open an image file
            $img = Image::make($file);

            $img->save('uploads/deliveries/' . $image_name);

            $data1 = (['image' => $image_name]);
            Delivery::where('id', $id)->update($data1);
        }

        /////////// For password change//////////////////
        $pass = request('password');
        if ($pass != null) {
            $data2 = ([
                'password' => Hash::make(request('password'))
            ]);
            Delivery::where('id', $id)->update($data2);

            Delivery::where('id', $id)->update($data);
            Auth::guard('delivery')->logout();
            return redirect()->route('delivery.login');
        }

        return back()->with('success', 'Succesfully Updated !!!');
    }
}
