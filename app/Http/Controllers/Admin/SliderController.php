<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Http\Traits\ImageTrait;

class SliderController extends Controller
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
        $this->imageUpload($request, $files, 'slider', 'sliders', $formImage);
    }


    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'sliders/' . $image);
        }
        $sliders = Slider::orderBy('id', 'asc')->where('delete_status', '0')->paginate(10);
        return view('admin.list.slider', compact('sliders'));
    }

    public function fetch(Request $request)
    {
        $sliderName = $request->sliderName;

        $sliders = Slider::orderBy('id', 'asc')
                ->where('delete_status', '0')
                ->when($sliderName, function ($query, $sliderName) {
                    return $query->where("title","LIKE","%$sliderName%");
                })
                ->paginate(10);
        return view('admin.list.ajaxlist.slider', compact('sliders'));
    }

    public function create()
    {
        return view('admin.form.slider');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,svg,png,gif|max:2048'
        ]);

        $slider =  new Slider();

        $slider->title = request('title');
        $slider->body = request('body');
        $slider->link = request('link');

        $slider->meta_desc = request('meta_desc');
        $slider->meta_keyword = request('meta_keyword');
        $slider->meta_title = request('meta_title');
        $slider->alt_img = request('alt_img');

        $slider->publish_status =  request('publish_status');
        $slider->hide_status =  request('hide_status');

        $slider->image = $request->session()->get('ajaximage');

        $slider->save();

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/sliders')->with('success', 'Slider added successsfully');
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('admin.form.slider', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::where('id', $id)->first();

        $this->validate(request(), [
            'title' => 'required',
            'image' => 'image|mimes:jpeg,jpg,svg,png,gif|max:2048'
        ]);

        $file = request()->file('image');
        if ($file != null) {
            $image = $slider->image;
            @unlink('uploads/' . 'sliders/' . $image);
            $data1 = ([
                'image' => $request->session()->get('ajaximage'),
            ]);
            Slider::where('id', $id)->update($data1);
        }

        $data = ([
            'title' => request('title'),
            'body' => request('body'),
            'link' => request('link'),
            'meta_desc' => request('meta_desc'),
            'meta_keyword' => request('meta_keyword'),
            'meta_title' => request('meta_title'),
            'alt_img' => request('alt_img'),
            'publish_status' => request('publish_status'),
            'hide_status' => request('hide_status')
        ]);

        Slider::where('id', $id)->update($data);

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/sliders')->with('success', 'Slider updated successfully');
    }

    public function destroy($id)
    {
        $slider = Slider::where('id', $id)->first();

        if (isset($slider)) {

            $data = ([
                'delete_status' => '1',
            ]);

            Slider::where('id', $id)->update($data);

            return redirect('/ns-admin/sliders')->with('success', 'Slider deleted successfully.');
        }
        return redirect('/ns-admin/sliders')->with('error', 'Slider deletion failed.');
    }

    public function ajaxSliderImgDestroy(Request $request){
        $slider_id = $request->deleteImage;

        $slider = Slider::where('id', $slider_id)->first();

        if ($slider != null) {
            $image = $slider->image;
            @unlink('uploads/' . 'sliders/' . $image);
            $data1 = ([
                'image' => null,
            ]);
            Slider::where('id', $slider_id)->update($data1);
            }

            return response()->json([
                "status" => "success",
                "message" => " image successfully deleted"
            ],200);

    }
}
