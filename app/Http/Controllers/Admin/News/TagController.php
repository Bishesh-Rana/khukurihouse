<?php

namespace App\Http\Controllers\Admin\News;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $tags = Tag::orderBy('id','asc')->where('delete_status','0')->get();
        return view('admin.list.tag',compact('tags'));
    }

    public function create()
    {
        return view('admin.form.tag');
    }

    public function store(Request $request)
    {
         //validate the form
         $this->validate(request(), [
            'tag_title' => 'required',
        ]);

        $tag = new Tag();

        $tag->tag_title = request('tag_title');
        $tag->tag_url = request('tag_url');
        $tag->tag_body = request('tag_body');
        $tag->publish_status = request('publish_status');
        $tag->featured_status = request('featured_status');

        $tag->save();

        return redirect('/ns-admin/tags')->with('success','Tag created successfully.');

    }

    public function edit($id)
    {
        $tag = Tag::where('id', $id)->first();
        return view('admin.form.tag',compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'tag_title' => 'required',
        ]);

        $data = ([
            'tag_title' => request('tag_title'),
            'tag_url' => request('tag_url'),
            'tag_body' => request('tag_body'),
            'publish_status' => request('publish_status'),
            'featured_status' => request('featured_status')
        ]);

        Tag::where('id', $id)->update($data);

        return redirect('/ns-admin/tags')->with('success','Tag updated successfully.');
    }

    public function destroy($id)
    {
        $tag = Tag::where('id', $id)->first();

        if(isset($tag))
        {
            $data = ([
                'delete_status' => '1',
            ]);

            Tag::where('id', $id)->update($data);
            return redirect('/ns-admin/tags')->with('success','Tag deleted successfully.');
        }
        return redirect('/ns-admin/tags')->with('error','Tag deletion failed.');
    }
}
