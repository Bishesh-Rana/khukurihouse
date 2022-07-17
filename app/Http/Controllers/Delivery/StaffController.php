<?php

namespace App\Http\Controllers\Delivery;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:delivery');
    }

    public function index(Request $request)
    {
        $staffs = Delivery::where('delete_status','0')
                ->where('parent_id',Auth::guard('delivery')->user()->id)
                ->orderBy('id','desc')
                ->paginate(10);
        return view('delivery.list.staff',compact('staffs'));
    }

    public function fetch(Request $request)
    {
        $staffName = $request->staffName;
        $staffEmail = $request->staffEmail;

        $staffs = Delivery::where('delete_status','0')
                ->where('parent_id',Auth::guard('delivery')->user()->id)
                ->when($staffName, function ($query, $staffName) {
                    return $query->where("first_name","LIKE","%$staffName%");
                })
                ->when($staffEmail, function ($query, $staffEmail) {
                    return $query->where("email","LIKE","%$staffEmail%");
                })
                ->orderBy('id','desc')
                ->paginate(10);

        return view('delivery.list.staffajax',compact('staffs'))->render();
    }

    public function create()
    {
        return view('delivery.form.staff');
    }

    public function store(Request $request,Delivery $delivery)
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            // 'username' => 'required|unique:tbl_deliveries,username,'.$delivery->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:tbl_deliveries,email,'.$delivery->id,
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        $delivery = new Delivery();

        $delivery->parent_id = Auth::guard('delivery')->user()->id;
        $delivery->first_name = request('first_name');
        $delivery->last_name = request('last_name');
        // $delivery->username = request('username');
        $delivery->password = Hash::make($request->password);
        $delivery->email = request('email');
        $delivery->publish_status = request('publish_status');

        $file = request()->file('image');

        if($file != null) {

            $image_name = "staff-".time().".".$file->clientExtension();

            $img = Image::make($file);

            $img->save('uploads/deliveries/'.$image_name);

            $delivery->image = $image_name;
        }

        $delivery->save();

        //redirect to dashboard
        return redirect('/ns-delivery/staffs')->with('success','Staff created successfully.');
    }

    public function edit($id)
    {
        $staff = Delivery::where('id', $id)->first();

        return view('delivery.form.staff',compact('staff'));
    }

    public function update(Request $request, $id,Delivery $delivery)
    {
        $staff = Delivery::where('id', $id)->first();

        $this->validate(request(), [

            'first_name' => 'required',
            'last_name' => 'required',
            // 'username' => 'required|unique:tbl_deliveries,username,'.$staff->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:tbl_deliveries,email,'.$staff->id,
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
        if($pass != null){
            $data2 = ([
                'password' => Hash::make(request('password'))
            ]);
            Delivery::where('id', $id)->update($data2);
        }

        $file = request()->file('image');

        if($file != null) {

            $image = $staff->image;
            @unlink('uploads/deliveries/'.$image);

            $image_name = "staff-".time().".".$file->clientExtension();

            $img = Image::make($file);

            $img->save('uploads/deliveries/'.$image_name);

            $data1 = (['image' => $image_name]);
            Delivery::where('id', $id)->update($data1);
        }

        Delivery::where('id', $id)->update($data);

        //redirect to dashboard
        return redirect('/ns-delivery/staffs')->with('success','Staff updated successfully.');
    }
}
