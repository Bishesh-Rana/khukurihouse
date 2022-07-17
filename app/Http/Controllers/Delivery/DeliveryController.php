<?php

namespace App\Http\Controllers\Delivery;

use Illuminate\Support\Facades\DB;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Traits\ImageTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DeliveryController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:delivery');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "image";
        $files = $request->file('image');
        $this->imageUpload($request, $files, 'delivery', 'deliveries', $formImage);
    }

    public function edit(){
        $countries = DB::table('all_values')
            ->select('all_values.*')
            ->get();
        $delivery = Delivery::where('id', Auth::guard('delivery')->user()->id)->firstorfail();
        return view('delivery.form.delivery',compact('delivery','countries'));
    }

    public function update(Request $request){

        $delivery_id = Auth::guard('delivery')->user()->id;
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
            'company_description' => request('company_description'),
            'holiday_mode'         => request('holiday_mode'),
            'pan_no'              => request('pan_no'),
            'vat_no'              => request('vat_no'),
            'bank_name'           => request('bank_name'),
            'bank_acc_number'     => request('bank_acc_number'),
        ]);

        Delivery::where('id', $delivery_id)->update($data);

        $pass = request('password');
        if($pass != null){
            $data2 = ([
                'password' => Hash::make(request('password'))
            ]);

            Delivery::where('id', $delivery_id)->update($data2);
            Auth::guard('delivery')->logout();
            return redirect()->route('delivery.login');
        }

        $request->session()->forget('ajaximage');

        //redirect to dashboard
        return back()->with('success','Delivery Information updated successfully.');
    }
}
