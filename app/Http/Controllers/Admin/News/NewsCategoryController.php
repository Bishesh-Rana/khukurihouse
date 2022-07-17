<?php

namespace App\Http\Controllers\Admin\News;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;

class NewsCategoryController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "parallex_img";
        $files = $request->file('parallex_img');
        $this->imageUpload($request, $files, 'parallex-news-category', 'newscategories', $formImage);
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'newscategories/' . $image);
        }
        $newsCategories = NewsCategory::orderBy('id','asc')->where('delete_status','0')->get();
        return view('admin.list.news_category',compact('newsCategories'));
    }

    public function create()
    {
        return view('admin.form.news_category');
    }

    public function store(Request $request)
    {
         //validate the form
         $this->validate(request(), [
            'category_title' => 'required',
        ]);

        $category = new NewsCategory();

        $category->category_title = request('category_title');
        $category->category_body = request('category_body');
        $str = strtolower($request->category_title);
        $category->category_url = preg_replace('/\s+/', '-', $str);
        $category->category_icon = request('category_icon');
        $category->external_link = request('external_link');
        $category->meta_title = request('meta_title');
        $category->meta_keyword = request('meta_keyword');
        $category->meta_description = request('meta_description');
        $category->publish_status = request('publish_status');
        $category->show_on_menu = request('show_on_menu');
        $category->featured_category = request('featured_category');

        $category->parallex_img = $request->session()->get('ajaximage');

        $category->featured_img = $request->session()->get('ajaximage');

        $category->save();

        $request->session()->forget('ajaximage');

        //redirect to dashboard
        return redirect('/ns-admin/newsCategories')->with('success','News Category created successfully.');

    }

    public function edit($id)
    {
        $category = NewsCategory::where('id', $id)->first();
        return view('admin.form.news_category',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = NewsCategory::find($id);
        $this->validate(request(), [
            'category_title' => 'required',
        ]);

        $str = strtolower($request->category_title);
        $data = ([
            'category_title' => request('category_title'),
            'category_body' => request('category_body'),
            'category_url' => preg_replace('/\s+/', '-', $str),
            'category_icon' => request('category_icon'),
            'external_link' => request('external_link'),
            'meta_title' => request('meta_title'),
            'meta_keyword' => request('meta_keyword'),
            'meta_description' => request('meta_description'),
            'publish_status' => request('publish_status'),
            'show_on_menu' => request('show_on_menu'),
            'featured_category' => request('featured_category')
        ]);

        $file = request()->file('parallex_img');
        if ($file != null) {
            $image = $category->parallex_img;
            @unlink('uploads/' . 'newscategories/' . $image);
            $data1 = ([
                'parallex_img' => $request->session()->get('ajaximage'),
            ]);
            NewsCategory::where('id', $id)->update($data1);
        }


        NewsCategory::where('id', $id)->update($data);

        $request->session()->forget('ajaximage');


        //redirect to dashboard
        return redirect('/ns-admin/newsCategories')->with('success','News Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = NewsCategory::where('id', $id)->first();

        if(isset($category))
        {
            $data = ([
                'delete_status' => '1',
            ]);

            NewsCategory::where('id', $id)->update($data);
            return redirect('/ns-admin/newsCategories')->with('success','News Category deleted successfully.');
        }
        return redirect('/ns-admin/newsCategories')->with('error','News Category deletion failed.');
    }

    public function removeFeature($category)
    {

        $photo = NewsCategory::where('featured_img', $category)->first();

        if(isset($photo))
        {
            //removing  image from folder
            $image = $photo->featured_img;
            @unlink('uploads/'.'categories/'.$image);

            //removing image from data base
            $data2 = (['featured_img' => null]);
            NewsCategory::where('featured_img', $category)
                ->update($data2);
            return back()->with('success','Photo deletion Success.');
        }
        return back()->with('error','Photo deletion failed.');
    }

    public function removeParallex($category)
    {
        $photo = NewsCategory::where('parallex_img', $category)->first();

        if(isset($photo))
        {
            //removing  image from folder
            $image = $photo->parallex_img;
            @unlink('uploads/'.'categories/'.$image);

            //removing image from data base
            $data2 = (['parallex_img' => null]);
            NewsCategory::where('parallex_img', $category)
                ->update($data2);
            return back()->with('success','Photo deletion Success.');
        }
        return back()->with('error','Photo deletion failed.');
    }
}
