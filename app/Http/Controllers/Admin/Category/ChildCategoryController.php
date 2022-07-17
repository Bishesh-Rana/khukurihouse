<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Models\SubCategory;
// use App\Models\ChildCategory;
use App\Http\Traits\ImageTrait;
// use App\Models\ParentCategory;

class ChildCategoryController extends Controller
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
        $this->imageUpload($request, $files, 'child-category', 'categories', $formImage);
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'categories/' . $image);
        }
        $childCategories = ChildCategory::where('delete_status', '0')->get();
        return view('admin.list.childcategories', compact('childCategories'));
    }

    public function create()
    {
        $parentCategories = ParentCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        $subCategories = SubCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        return view('admin.form.childcategories', compact('subCategories','parentCategories'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'child_category_name' => 'required',
            'child_category_slug' => 'required|unique:tbl_child_categories,child_category_slug',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'

        ]);

        $cat = new ChildCategory();

        $cat->child_category_name = request('child_category_name');
        $cat->child_category_slug = str_slug(request('child_category_slug'));
        $cat->image = $request->session()->get('ajaximage');
        $cat->publish_status = request('publish_status');
        $cat->sub_category_id = request('sub_category_id');
        $cat->meta_title = request('meta_title');
        $cat->meta_keyword = request('meta_keyword');
        $cat->meta_description = request('meta_description');

        $cat->save();

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/childCategories')->with('success', 'Child Category created successfully.');
    }

    public function edit($id)
    {
        $parentCategories = ParentCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        $subCategories = SubCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        $childCategory = ChildCategory::where('id', $id)->first();
        return view('admin.form.childcategories', compact('parentCategories','subCategories', 'childCategory'));
    }

    public function update(Request $request, $id)
    {
        $childCategory = ChildCategory::where('id', $id)->first();

        $this->validate(request(), [
            'child_category_name' => 'required',
            'child_category_slug' => 'required|',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $file = request()->file('image');
        if ($file != null) {
            $image = $childCategory->image;
            @unlink('uploads/' . 'categories/' . $image);
            $data1 = ([
                'image' => $request->session()->get('ajaximage'),
            ]);
            ChildCategory::where('id', $id)->update($data1);
        }

        $data = ([
            'child_category_name' => request('child_category_name'),
            'child_category_slug' => str_slug(request('child_category_slug')),
            'sub_category_id' => request('sub_category_id'),
            'publish_status' => request('publish_status'),
            'meta_title' => request('meta_title'),
            'meta_keyword' => request('meta_keyword'),
            'meta_description' => request('meta_description'),
        ]);

        ChildCategory::where('id', $id)->update($data);

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/childCategories')->with('success', 'Child Category updated successfully.');
    }

    public function destroy($id)
    {
        $childCategory = ChildCategory::where('id', $id)->first();

        if (isset($childCategory)) {
            $data = ([
                'delete_status' => '1'
            ]);

            ChildCategory::where('id', $id)->update($data);

            return redirect('/ns-admin/childCategories')->with('success', 'Child Category deleted successfully.');
        }

        return redirect('/ns-admin/childCategories')->with('error', 'Child Category not found.');
    }
}
