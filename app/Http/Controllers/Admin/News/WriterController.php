<?php

namespace App\Http\Controllers\Admin\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Writer;
use Intervention\Image\Facades\Image;
use App\Http\Traits\ImageTrait;


class WriterController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'writers/' . $image);
        }
        $writers = Writer::orderBy('id', 'asc')->where('delete_status', '0')->get();
        return view('admin.list.writer', compact('writers'));
    }

    public function create()
    {
        $writers =  Writer::get();
        return view('admin.form.writer', compact('writers'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'writer_title' => 'required',
            'writer_body' => 'required',
            'writer_designation' => 'required',
            'writer_designation' => 'required',
            'writer_phone' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'writer_address' => 'required',
            'writer_email' => 'required|email',
            'writer_address' => 'required',
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $writer = new Writer();
        $writer->writer_title = request('writer_title');
        $writer->writer_type = request('writer_type');
        $writer->writer_body = request('writer_body');
        $writer->writer_designation = request('writer_designation');
        $writer->writer_phone = request('writer_phone');
        $writer->writer_address = request('writer_address');
        $writer->writer_email = request('writer_email');
        $writer->writer_facebook = request('writer_facebook');
        $writer->writer_youtube = request('writer_youtube');
        $writer->writer_twitter = request('writer_twitter');
        $writer->writer_type = request('writer_type');
        $writer->publish_status = request('publish_status');

        $writer->featured_img = request()->session()->get('ajaximage');

        $writer->save();

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/writers')->with('success', 'Writer Added Successfully');
    }

    public function edit($id)
    {
        $writer = Writer::where('id', $id)->first();
        return view('admin.form.writer', compact('writer'));
    }

    public function update(Request $request, $id)
    {
        $writer = Writer::where('id',$id)->first();

        $this->validate(request(), [
            'writer_title' => 'required',
            'writer_body' => 'required',
            'writer_designation' => 'required',
            'writer_designation' => 'required',
            'writer_phone' => 'required|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'writer_address' => 'required',
            'writer_email' => 'required|email',
            'writer_address' => 'required',
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = ([
            'writer_title' => request('writer_title'),
            'writer_type' => request('writer_type'),
            'writer_body' => request('writer_body'),
            'publish_status' => request('publish_status'),
            'writer_designation' => request('writer_designation'),
            'writer_phone' => request('writer_phone'),
            'writer_address' => request('writer_address'),
            'writer_email' => request('writer_email'),
            'writer_facebook' => request('writer_facebook'),
            'writer_youtube' => request('writer_youtube'),
            'writer_twitter' => request('writer_twitter'),
            'writer_type' => request('writer_type'),
            'publish_status' => request('publish_status')
        ]);

        $file = request()->file('featured_img');
        if ($file != null) {
            $image = $writer->featured_img;
            @unlink('uploads/' . 'writers/' . $image);
            $data1 = ([
                'featured_img' => $request->session()->get('ajaximage'),
            ]);
            Writer::where('id', $id)->update($data1);
        }

        Writer::where('id', $id)->update($data);

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/writers')->with('success', 'Writer updated successfully');
    }

    public function destroy($id)
    {
        $writer =  Writer::where('id', $id)->first();

        if (isset($writer)) {
            $data = ([
                'delete_status' => '1'
            ]);

            Writer::where('id', $id)->update($data);

            return redirect('/ns-admin/writers')->with('success', 'Writer deleted successfully');
        }
        return redirect('/ns-admin/writer')->with('error', 'Writer Deletion Failed');
    }

    public function removeFeature($writer)
    {
        $photo = Writer::where('featured_img', $writer)->first();

        if (isset($photo)) {
            //removing  image from folder
            $image = $photo->featured_img;
            @unlink('uploads/' . 'writers/' . $image);

            //removing image from data base
            $data2 = (['featured_img' => null]);
            Writer::where('featured_img', $writer)->update($data2);
            return back()->with('success', 'Photo Deleted Successfully');
        }
        return back()->with('error', 'Photo deletion failed');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "featured_img";
        $files = $request->file('featured_img');
        $this->imageUpload($request, $files, 'featured-writer', 'writers', $formImage);
    }

}
