<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $coupons = Coupon::where('delete_status','0')->orderBy('id', 'DESC')->get();
        return view('admin.list.coupon', compact('coupons'));
    }

    public function create()
    {
        $coupons =  Coupon::get();
        return view('admin.form.coupon', compact('coupons'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'discount_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_name = request('coupon_name');
        $coupon->coupon_description = request('coupon_description');
        $coupon->coupon_code = request('coupon_code');
        $coupon->discount_price = request('discount_price');
        $coupon->start_date = request('start_date');
        $coupon->end_date = request('end_date');
        $coupon->publish_status = request('publish_status');

        $coupon->save();

        return redirect('/ns-admin/coupons')->with('success', 'Coupon Created Successfully');
    }

    public function edit($id)
    {
        $coupon = Coupon::where('id', $id)->first();
        return view('admin.form.coupon', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::where('id',$id)->first();

        $this->validate(request(), [
            'coupon_name' => 'required',
            'coupon_code' => 'required',
            'discount_price' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $data = ([
            'coupon_name' => request('coupon_name'),
            'coupon_description' => request('coupon_description'),
            'coupon_code' => request('coupon_code'),
            'discount_price' => request('discount_price'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'publish_status' => request('publish_status'),
        ]);

        Coupon::where('id', $id)->update($data);

        return redirect('/ns-admin/coupons')->with('success', 'Coupon updated successfully');
    }

    public function destroy($id)
    {
        $coupon =  Coupon::where('id', $id)->first();

        if (isset($coupon)) {
            $data = ([
                'delete_status' => '1'
            ]);

            Coupon::where('id', $id)->update($data);

            return redirect('/ns-admin/coupons')->with('success', 'Coupon deleted successfully');
        }
        return redirect('/ns-admin/coupon')->with('error', 'Coupon does not exist');
    }
}
