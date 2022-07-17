<?php

namespace App\Http\Controllers\Delivery;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StaffProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:delivery');
    }

    public function show()
    {
        $vendor = Delivery::where('id', Auth::guard('delivery')->user()->id)->firstorfail();

        if ($vendor->delivery) {
            $delivery_profile_count_info = Delivery::where('delete_status', '0')->where('publish_status', '1')
                ->where('id', Auth::guard('delivery')->user()->id)
                ->select(
                    'image',
                    'first_name',
                    'last_name',
                    'email'
                )
                ->first();
            $profile_count = $delivery_profile_count_info->delivery_profile_information;

            $delivery = Delivery::where('id', Auth::guard('delivery')->user()->id)->first();
            abort_if(!$delivery, 404);

            return view('delivery.pages.staffprofile', compact('delivery', 'profile_count'));
        }
    }

    public function edit()
    {
        $vendor = Delivery::where('id', Auth::guard('delivery')->user()->id)->firstorfail();
        if ($vendor->delivery) {
            $staff = Delivery::where('id', Auth::guard('delivery')->user()->id)->first();
            abort_if(!$staff, 404);
            return view('delivery.form.staff_profile', compact('staff'));
        }
    }

    public function update(Request $request, $id)
    {
        $staff = Delivery::where('id', $id)->first();

        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            // 'username' => 'required|unique:tbl_deliveries,username,' . $staff->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:tbl_deliveries,email,' . $staff->id,
            'password' => 'required_with:password_confirmation|same:password_confirmation',
        ]);

        $data = ([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            // 'username' => request('username'),
            'email' => request('email'),
            'publish_status' => request('publish_status'),
        ]);

        /////////// For password change//////////////////
        $pass = request('password');
        if ($pass != null) {
            $data2 = ([
                'password' => Hash::make(request('password'))
            ]);
            Delivery::where('id', $id)->update($data2);
        }

        $file = request()->file('image');

        if ($file != null) {

            //deleting previous image
            $image = $staff->image;
            @unlink('uploads/deliveries/' . $image);

            $image_name = "staff-" . time() . "." . $file->clientExtension();

            // open an image file
            $img = Image::make($file);

            $img->save('uploads/deliveries/' . $image_name);

            $data1 = (['image' => $image_name]);
            Delivery::where('id', $id)->update($data1);
        }

        Delivery::where('id', $id)->update($data);

        //redirect to dashboard
        return redirect()->route('delivery.staff.profile.show')->with('success', 'Profile updated successfully.');
    }
}
