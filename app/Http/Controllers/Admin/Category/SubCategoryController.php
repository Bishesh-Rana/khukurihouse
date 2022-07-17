<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\ParentCategory;
use App\SubCategory;

class SubCategoryController extends Controller
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
        $this->imageUpload($request, $files, 'sub-category', 'categories', $formImage);
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'categories/' . $image);
        }
        $subCategories = SubCategory::where('delete_status', '0')->get();
        return view('admin.list.subcategories', compact('subCategories'));
    }

    public function create()
    {
        $parentCategories = ParentCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        return view('admin.form.subcategories', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'sub_category_name' => 'required',
            'sub_category_slug' => 'required|unique:tbl_sub_categories,sub_category_slug',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $cat = new SubCategory();

        $cat->sub_category_name = request('sub_category_name');
        $cat->sub_category_slug = str_slug(request('sub_category_slug'));
        $cat->image = $request->session()->get('ajaximage');
        $cat->publish_status = request('publish_status');
        $cat->parent_category_id = request('parent_category_id');
        $cat->meta_title = request('meta_title');
        $cat->meta_keyword = request('meta_keyword');
        $cat->meta_description = request('meta_description');

        $cat->save();

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/subCategories')->with('success', 'Sub Category created successfully.');
    }

    public function edit($id)
    {
        $parentCategories = ParentCategory::where('publish_status', '1')->where('delete_status', '0')->get();
        $subCategory = SubCategory::where('id', $id)->first();
        return view('admin.form.subcategories', compact('parentCategories', 'subCategory'));
    }

    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::where('id', $id)->first();

        $this->validate(request(), [
            'sub_category_name' => 'required',
            'sub_category_slug' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $file = request()->file('image');
        if ($file != null) {
            $image = $subCategory->image;
            @unlink('uploads/' . 'categories/' . $image);
            $data1 = ([
                'image' => $request->session()->get('ajaximage'),
            ]);
            SubCategory::where('id', $id)->update($data1);
        }

        $data = ([
            'sub_category_name' => request('sub_category_name'),
            'sub_category_slug' => str_slug(request('sub_category_slug')),
            'parent_category_id' => request('parent_category_id'),
            'publish_status' => request('publish_status'),
            'meta_title' => request('meta_title'),
            'meta_keyword' => request('meta_keyword'),
            'meta_description' => request('meta_description'),
        ]);

        SubCategory::where('id', $id)->update($data);

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/subCategories')->with('success', 'Sub Category updated successfully.');
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::where('id', $id)->first();

        if (isset($subCategory)) {
            if (count($subCategory->childcategory) > 0) { //relationship exists?
                foreach ($subCategory->childcategory as $item) {
                    if ($item->delete_status == 0) {
                        return redirect('/ns-admin/subCategories')->with('error', 'Sub Category not empty.');
                    } else {
                        dd('deleted');
                        $data = ([
                            'delete_status' => '1'
                        ]);

                        SubCategory::where('id', $id)->update($data);

                        return redirect('/ns-admin/subCategories')->with('success', 'Sub Category deleted successfully.');
                    }
                }
            } else {
                dd('deleted');
                $data = ([
                    'delete_status' => '1'
                ]);

                SubCategory::where('id', $id)->update($data);

                return redirect('/ns-admin/subCategories')->with('success', 'Sub Category deleted successfully.');
            }
        }

        return redirect('/ns-admin/subCategories')->with('error', 'Sub Category not found.');
    }
}
