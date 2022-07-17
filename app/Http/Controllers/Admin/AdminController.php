<?php

namespace App\Http\Controllers\Admin;

// use Auth;
// use Image;
use Intervention\Image\Facades\Image;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        // $request->session()->forget('adminsearch');
        $admins = Admin::orderBy('id','desc')->get();
        $i=0;
        foreach($admins as $admin)
        {
            $roles = $admin->getRoleNames();
            $admins[$i]->setAttribute('roles',$roles);
            $i++;
        }
        return view('admin.list.admin',compact('admins'));
    }

    public function create(Admin $admin)
    {
        // if(\Gate::denies('create',$admin)){
        //     return redirect('/admin');
        // }
        // if(1 !== Auth::guard('admin')->user()->id){
        //     abort(403);
        // }
        $roles = Role::get();
        // dd($roles);
        return view('admin.form.admin',compact('roles'));
    }

    public function store(Request $request,Admin $admin)
    {
        //validate the form
        $this->validate(request(), [

            'name' => 'required',
            'username' => 'required|unique:tbl_admins|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:tbl_admins,email,'.$admin->id,
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'

        ]);
        //dd('wait');
        //create and save category
        $admin = new Admin();

        $admin->name = request('name');
        $admin->username = request('username');
        $admin->password = Hash::make($request->password);
        $admin->email = request('email');
        $admin->publish_status = request('publish_status');

        $file = request()->file('image');

        if($file != null) {

            $image_name = "admin-".time().".".$file->clientExtension();

            // open an image file
            $img = Image::make($file);

            // save image in desired format
            $img->save('uploads/'.'admins/'.$image_name);

            $admin->image = $image_name;
        }

        $admin->save();

        $roleId = request('roles');

        if($roleId !== null){
            foreach($roleId as $role){
                // dd($role);
                $user = Admin::where('id',$admin->id)->first();
                $user->assignRole($role);
            }
        }

        //redirect to dashboard
        return redirect('/ns-admin/admins')->with('success','Admin created successfully.');
    }

    public function edit($id)
    {
        // $id = $admin->id;
        // if($admin->id !== Auth::guard('admin')->user()->id){
        //     abort(403);
        // }
        $admin = Admin::where('id', $id)->first();
        $roles = Role::get();
        $roleSelected = $admin->getRoleNames();
        // dd($roleSelected[1]);

        // dd($admin);
        return view('admin.form.admin',compact('admin','roles','roleSelected'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        $this->validate(request(), [

            'name' => 'required',
            'username' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required',
            'password' => 'required_with:password_confirmation|same:password_confirmation',

        ]);

        $data = ([
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'publish_status' => request('publish_status'),
        ]);

        /////////// For password change//////////////////
        $pass = request('password');
        if($pass != null){
            $data2 = ([
                'password' => Hash::make(request('password'))
            ]);
            Admin::where('id', $id)->update($data2);
        }

        $file = request()->file('image');

        if($file != null) {

            //deleting previous image
            $image = $admin->image;
            @unlink('uploads/'.'admins/'.$image);

            $image_name = "admin-".time().".".$file->clientExtension();

            // open an image file
            $img = Image::make($file);

            $img->save('uploads/'.'admins/'.$image_name);

            $data1 = (['image' => $image_name]);
            Admin::where('id', $id)->update($data1);
        }

        Admin::where('id', $id)->update($data);

        $user = Admin::where('id',$id)->first();
        $user->roles()->detach();
        $roleId = request('roles');
        // dd($roleId);
        if($roleId !== null){
            foreach($roleId as $role){
                // dd($role);
                $user = Admin::where('id',$id)->first();
                // dd($role);
                $user->assignRole($role);
            }
        }

        //redirect to dashboard
        return redirect('/ns-admin/admins')->with('success','Admin updated successfully.');
    }

    public function destroy($id)
    {
        abort_if(auth()->id() != 1, 403);
        $admin = Admin::where('id', $id)->first();

        if(isset($admin))
        {
            // $image = $admin->image;
            // @unlink('uploads/'.'admins/'.$image);
            $data = ([
                'delete_status' => '1',
            ]);
            //deleting admin
            Admin::where('id', $id)->update($data);
            return redirect('/ns-admin/admins')->with('success','Admin deleted successfully.');
        }

        return redirect('/ns-admin/admins')->with('error','Admin deletion failed.');
    }
}
