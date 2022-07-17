<?php

namespace App\Http\Controllers\Admin;

use Intervention\Image\Facades\Image;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;

class SettingController extends Controller
{
    use ImageTrait;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "site_logo";
        $files = $request->file('site_logo');
        $this->imageUpload($request, $files, 'setting', 'settings', $formImage);
    }

    public function create(Request $request)
    {

        $setting = Setting::get()->first();
        return view('admin.form.setting', compact('setting'));
    }

    public function store(Request $request)
    {
        //validate the form
        $this->validate(request(), [
            'site_name' => 'required',
            'site_url' => 'required',
            'site_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //create and save category
        $setting = new Setting();

        $setting->site_name = request('site_name');
        $setting->address = request('address');
        $setting->phone = request('phone');
        $setting->email = request('email');
        $setting->site_url = request('site_url');
        $setting->facebook = request('facebook');
        $setting->linkedin = request('linkedin');
        $setting->twitter = request('twitter');
        $setting->instagram = request('instagram');
        $setting->youtube = request('youtube');
        $setting->viber = request('viber');
        $setting->whatsapp = request('whatsapp');
        $setting->map_link = request('map_link');
        $setting->map_embed_link = request('map_embed_link');
        $setting->operation = request('operation');
        $setting->privacy_policy = request('privacy_policy');
        $setting->terms_and_conditions = request('terms_and_conditions');
        $setting->expressCharge = request('expressCharge');

        $setting->dollar_rate = request('dollar_rate');
        $setting->vat = request('vat');
        $setting->payment_fee = request('payment_fee');

        $setting->register_reward = request('register_reward');
        $setting->purchase_reward = request('purchase_reward');
        $setting->refer_reward = request('refer_reward');

        $setting->meta_title = request('meta_title');
        $setting->meta_keyword = request('meta_keyword');
        $setting->meta_description = request('meta_description');

        $setting->site_logo = $request->session()->get('ajaximage');

        $file = request()->file('site_mini_logo');

        if ($file != null) {
            $img_name = 'site-mini-logo-' . time() . '.' . $file->clientExtension();

            $img = Image::make($file);

            $img->save('uploads/settings/' . $img_name);

            $setting->site_mini_logo = $img_name;
        }

        $setting->save();

        //redirect to dashboard
        return redirect('/ns-admin/settings')->with('success', 'Setting created successfully.');
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);

        //validate the form
        $this->validate(request(), [
            'site_name' => 'required',
            'site_url' => 'required',
            // 'site_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = request()->file('site_logo');
        if ($file != null) {
            // dd('file not null');
            $image = $setting->site_logo;
            @unlink('uploads/' . 'settings/' . $image);
            $data1 = ([
                'site_logo' => $request->session()->get('ajaximage'),
            ]);
            Setting::where('id', $id)->update($data1);
        }

        $file1 = request()->file('site_mini_logo');

        if ($file1 != null) {
            $image = $setting->site_mini_logo;
            @unlink('uploads/settings/' . $image);

            $img_name = 'site-mini-logo-' . time() . '.' . $file1->clientExtension();
            $img = Image::make($file1);
            $img->save('uploads/settings/' . $img_name);

            $data3 = (['site_mini_logo' => $img_name]);

            Setting::where('id', $id)->update($data3);
        }

        $data = ([
            'site_name' => request('site_name'),
            'address' => request('address'),
            'phone' => request('phone'),
            'email' => request('email'),
            'site_url' => request('site_url'),
            'linkedin' => request('linkedin'),
            'facebook' => request('facebook'),
            'twitter' => request('twitter'),
            'instagram' => request('instagram'),
            'youtube' => request('youtube'),
            'viber' => request('viber'),
            'whatsapp' => request('whatsapp'),
            'map_embed_link' => request('map_embed_link'),
            'map_link' => request('map_link'),
            'operation' => request('operation'),
            'privacy_policy' => request('privacy_policy'),
            'terms_and_conditions' => request('terms_and_conditions'),

            'dollar_rate' => request('dollar_rate'),
            'vat' => request('vat'),
            'payment_fee' => request('payment_fee'),

            'register_reward' => request('register_reward'),
            'purchase_reward' => request('purchase_reward'),
            'refer_reward' => request('refer_reward'),

            'meta_title' => request('meta_title'),
            'meta_keyword' => request('meta_keyword'),
            'meta_description' => request('meta_description'),
            'expressCharge' => request('expressCharge'),
        ]);

        Setting::where('id', $id)->update($data);

        //redirect to dashboard
        return redirect('/ns-admin/settings')->with('success', 'Setting updated successfully.');
    }
}
