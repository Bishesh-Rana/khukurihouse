<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Traits\ImageTrait;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "featured_img";
        $files = $request->file('featured_img');
        // dd($files);
        $this->imageUpload($request, $files, 'feature', 'contents', $formImage);
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'contents/' . $image);
        }
        $contents = Content::orderBy('position', 'asc')->where('delete_status', '0')->get();
        return view('admin.list.content', compact('contents'));
    }

    public function create()
    {
        $contents = Content::where('delete_status', '0')->where('parent_id', 0)->get();
        $products = Product::where('publish_status', '1')->where('delete_status', '0')->get();
        // dd($contents);
        return view('admin.form.content', compact('contents','products'));
    }

    public function store(Request $request)
    {
        //validate the form
        $this->validate(request(), [
            'content_title' => 'required',
            'content_type' => 'required',
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //create and save category
        $content = new Content();

        $content->content_title = request('content_title');
        $content->content_type = request('content_type');
        $content->content_body = request('content_body');
        $content->content_url = Str::slug($request->content_title);
        $content->external_link = request('external_link');
        $content->content_icon = request('content_icon');
        $content->parent_id = request('parent_id');
        $content->position = request('position');
        $content->meta_title = request('meta_title');
        $content->meta_keyword = request('meta_keyword');
        $content->meta_description = request('meta_description');
        $content->publish_status = request('publish_status');
        $content->show_on_menu = request('show_on_menu');
        $content->featured_img = $request->session()->get('ajaximage');

        $content->save();

        $product_ids = request('product_id');
        $content->products()->attach($product_ids);

        $request->session()->forget('ajaximage');
        //redirect to dashboard
        return redirect('/ns-admin/contents')->with('success', 'Content created successfully.');
    }

    public function edit($id)
    {
        $contents = Content::where('delete_status', '0')->where('parent_id', 0)->get();
        $content = Content::where('id', $id)->first();
        $products = Product::where('publish_status', '1')->where('delete_status', '0')->get();
        // dd($content->products);
        return view('admin.form.content', compact('content', 'contents','products'));
    }

    public function update(Request $request, $id)
    {
        $content = Content::where('id', $id)->first();
        //validate the form
        $this->validate(request(), [
            'content_title' => 'required',
            'content_type' => 'required',
            'featured_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $simage = request()->file('featured_img');

        if ($simage != null) {
            $image = $content->featured_img;
            @unlink('uploads/' . 'contents/' . $image);

            $data1 = ([
                'featured_img' => $request->session()->get('ajaximage'),
            ]);
            Content::where('id', $id)->update($data1);
        }

        $data = ([
            'content_title' => request('content_title'),
            'content_type' => request('content_type'),
            'content_body' => request('content_body'),
            'content_url' => Str::slug($request->content_title),
            'parent_id' => request('parent_id'),
            'position' => request('position'),
            'external_link' => request('external_link'),
            'content_icon' => request('content_icon'),
            'meta_title' => request('meta_title'),
            'meta_keyword' => request('meta_keyword'),
            'meta_description' => request('meta_description'),
            'publish_status' => request('publish_status'),
            'show_on_menu' => request('show_on_menu'),
        ]);

        Content::where('id', $id)->update($data);

        //adding selected products
        $product_ids = request('product_id');
        $content->products()->sync($product_ids);

        $request->session()->forget('ajaximage');
        //redirect to dashboard
        return redirect('/ns-admin/contents')->with('success', 'Content updated successfully.');
    }

    public function destroy($id)
    {
        $content = Content::where('id', $id)->first();

        if (isset($content)) {
            $data = ([
                'delete_status' => '1',
            ]);

            //deleting admin
            Content::where('id', $id)->update($data);
            return redirect('/ns-admin/contents')->with('success', 'Content deleted successfully.');
        }
        return redirect('/ns-admin/contents')->with('error', 'Content not found.');
    }

    public function removeFeature($content)
    {
        $photo = Content::where('featured_img', $content)->first();

        if (isset($photo)) {
            $image = $photo->featured_img;
            @unlink('uploads/contents/' . $image);

            $data2 = (['featured_img' => null]);
            Content::where('featured_img', $content)->update($data2);
            return back()->with('success', 'Photo deletion Success.');
        }
        return back()->with('error', 'Photo deletion failed.');
    }

    public function updateOrder(Request $request)
    {
        $contents = Content::all();
        // dd($request->all());
        foreach ($contents as $content) {
            $content->timestamps = false; // To disable update_at field updation
            $id = $content->id;

            foreach ($request->position as $position) {
                if ($position['id'] == $id) {
                    $content->update(['position' => $position['position']]);
                }
            }
        }

        return response()->json([
            'msg' => 'Update Successfully.'
        ], 200);
    }
}
