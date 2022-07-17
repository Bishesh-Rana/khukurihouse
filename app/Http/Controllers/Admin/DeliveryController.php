<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Delivery;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ImageTrait;
use App\Http\Requests\DeliveryRegistrationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class DeliveryController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "image";
        $files = $request->file('image');
        $this->imageUpload($request, $files, 'delivery', 'deliveries', $formImage);
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/deliveries/' . $image);
        }
        $deliveries = Delivery::where('delete_status', '0')->latest()->get();
        return view('admin.list.delivery', compact('deliveries'));
    }

    public function create()
    {
        $countries = DB::table('countries')->select('countries.*')->get();
        return view('admin.form.delivery',compact('countries'));
    }

    public function store(DeliveryRegistrationRequest $request)
    {
        $delivery = new Delivery();

        $delivery->company_name        = request('company_name');
        $delivery->company_website     = request('company_website');
        // $delivery->business_type       = request('business_type');
        $delivery->company_country     = request('company_country');
        $delivery->company_city        = request('company_city');
        $delivery->company_state       = request('company_state');
        $delivery->company_address     = request('company_address');
        $delivery->zip_code            = request('zip_code');
        $delivery->company_phone       = request('company_phone');
        $delivery->email               = request('email');
        $delivery->first_name          = request('first_name');
        $delivery->middle_name         = request('middle_name');
        $delivery->last_name           = request('last_name');
        // $delivery->company_offer       = request('company_offer');
        $delivery->company_description = request('company_description');
        // $delivery->username            = request('username');
        $delivery->password            = Hash::make($request->password);
        $delivery->publish_status      = request('publish_status');
        $delivery->delivery_code         = Str::random(6);
        $delivery->activation_code     = Str::random(25);
        $delivery->image               = $request->session()->get('ajaximage');

        $delivery->pan_no              = request('pan_no');
        $delivery->vat_no              = request('vat_no');
        $delivery->bank_name           = request('bank_name');
        $delivery->bank_acc_number     = request('bank_acc_number');

        $delivery->save();
        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/deliveries')->with('success','Delivery created successfully.');
    }

    public function edit($delivery_id)
    {
        $countries = DB::table('countries')
                    ->select('countries.*')
                    ->get();
        $delivery = Delivery::where('id',$delivery_id)->firstorfail();
        return view('admin.form.delivery',compact('delivery','countries'));
    }

    public function update(DeliveryRegistrationRequest $request, $delivery_id)
    {
        $delivery = Delivery::where('id',$delivery_id)->firstorfail();

        $simage = request()->file('image');

        if($simage != null) {
            $image = $delivery->image;
            @unlink('uploads/deliveries/'.$image);

            $data1 = ([
                'image' => $request->session()->get('ajaximage'),
            ]);
            Delivery::where('id', $delivery_id)->update($data1);
        }

        $data = ([
            'company_name'        => request('company_name'),
            'company_website'     => request('company_website'),
            // 'business_type'       => request('business_type'),
            'company_country'     => request('company_country'),
            'company_city'        => request('company_city'),
            'company_state'       => request('company_state'),
            'company_address'     => request('company_address'),
            'zip_code'            => request('zip_code'),
            'company_phone'       => request('company_phone'),
            'email'               => request('email'),
            'first_name'          => request('first_name'),
            'middle_name'         => request('middle_name'),
            'last_name'           => request('last_name'),
            // 'company_offer'       => request('company_offer'),
            'company_description' => request('company_description'),
            // 'username'            => request('username'),
            'publish_status'      => request('publish_status'),
            'pan_no'              => request('pan_no'),
            'vat_no'              => request('vat_no'),
            'bank_name'           => request('bank_name'),
            'bank_acc_number'     => request('bank_acc_number'),
        ]);
        Delivery::where('id', $delivery_id)->update($data);

        $request->session()->forget('ajaximage');

        //redirect to dashboard
        return redirect('/ns-admin/deliveries')->with('success','Delivery Information updated successfully.');
    }
}
