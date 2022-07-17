<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;

class BrandController extends Controller
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
        $this->imageUpload($request, $files, 'brand', 'brands', $formImage);
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/brands/' . $image);
        }
        $brands = Brand::orderBy('id', 'asc')->where('delete_status', '0')->get();
        return view('admin.list.brand', compact('brands'));
    }

    public function create()
    {
        return view('admin.form.brand');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,svg,png,gif|max:2048'
        ]);

        $brand =  new Brand();

        $brand->title = request('title');
        $brand->link = request('link');
        $brand->publish_status =  request('publish_status');

        $brand->image = $request->session()->get('ajaximage');

        $brand->save();

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/brands')->with('success', 'Brand added successsfully');
    }

    public function edit($id)
    {
        $brand = Brand::where('id', $id)->first();
        return view('admin.form.brand', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::where('id', $id)->first();

        $this->validate(request(), [
            'title' => 'required',
            'image' => 'image|mimes:jpeg,jpg,svg,png,gif|max:2048'
        ]);

        $file = request()->file('image');
        if ($file != null) {
            $image = $brand->image;
            @unlink('uploads/brands/' . $image);
            $data1 = ([
                'image' => $request->session()->get('ajaximage'),
            ]);
            Brand::where('id', $id)->update($data1);
        }

        Brand::where('id', $id)->update([
            'title' => request('title'),
            'link' => request('link'),
            'publish_status' => request('publish_status')
        ]);

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/brands')->with('success', 'Brand updated successfully');
    }

    public function destroy($id)
    {
        $brand = Brand::where('id', $id)->first();

        if (isset($brand)) {
            Brand::where('id', $id)->update([
                'delete_status' => '1',
            ]);
            return redirect('/ns-admin/brands')->with('success', 'Brand deleted successfully.');
        }
        return redirect('/ns-admin/brands')->with('error', 'Brand not found.');
    }

    public function removeImage($id)
    {
        $brand = Brand::where('id', $id)->first();

        if (isset($brand)) {
            $image = $brand->image;
            @unlink('uploads/brands/' . $image);

            Brand::where('id', $id)->update(['image' => null]);
            return back()->with('success', 'Photo deleted successfully.');
        }
        return back()->with('error', 'Photo not found.');
    }
}
