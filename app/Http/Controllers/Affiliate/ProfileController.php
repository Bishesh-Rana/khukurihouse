<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\Affiliate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:affiliate');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "image";
        $files = $request->file('image');
        $this->imageUpload($request, $files, 'affiliate', 'affiliates', $formImage);
    }

    public function edit(){
        $affiliate = Affiliate::where('id', Auth::guard('affiliate')->user()->id)->firstorfail();
        return view('affiliate.form.affiliate',compact('affiliate'));
    }

    public function update(Request $request)
    {
        $id = Auth::guard('affiliate')->user()->id;
        $affiliate = Affiliate::find($id);

        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            // 'username' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required',
            'password' => 'required_with:password_confirmation|same:password_confirmation',
        ]);

        $data = ([
            'first_name'       => request('first_name'),
            'middle_name'      => request('middle_name'),
            'last_name'        => request('last_name'),
            // 'username' => request('username'),
            'email'            => request('email'),
            'address'          => request('address'),
            'phone'            => request('phone'),
            'email'            => request('email'),
            'pan_no'           => request('pan_no'),
            'vat_no'           => request('vat_no'),
            'bank_name'        => request('bank_name'),
            'bank_acc_number'  => request('bank_acc_number'),
            // 'affiliate_code'   => \Str::slug(request('first_name')) . '-' . rand(100000, 999999)
        ]);

        $file = request()->file('image');

        if ($file != null) {
            //deleting previous image
            $image = $affiliate->image;
            @unlink('uploads/' . 'affiliates/' . $image);

            $image_name = "affiliate-" . time() . "." . $file->clientExtension();

            // open an image file
            $img = Image::make($file);

            $img->save('uploads/' . 'affiliates/' . $image_name);

            $data1 = (['image' => $image_name]);
            Affiliate::where('id', $id)->update($data1);
        }

        /////////// For password change//////////////////
        $pass = request('password');
        if ($pass != null) {
            $data2 = ([
                'password' => Hash::make(request('password'))
            ]);
            Affiliate::where('id', $id)->update($data2);

            Affiliate::where('id', $id)->update($data);
            Auth::guard('affiliate')->logout();
            return redirect()->route('affiliate.login');
        }

        return back()->with('success', 'Succesfully Updated !!!');
    }


}
