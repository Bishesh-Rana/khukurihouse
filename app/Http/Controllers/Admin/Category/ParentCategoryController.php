<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\ParentCategory;

class ParentCategoryController extends Controller
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
        $this->imageUpload($request, $files, 'parent-category', 'categories', $formImage);
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'categories/' . $image);
        }
        $parentCategories = ParentCategory::where('delete_status', '0')->get();
        return view('admin.list.parentcategories', compact('parentCategories'));
    }

    public function create()
    {
        // $categoryLists = ParentCategory::where('delete_status', '0')->where('parent_id','0')->get();
        // // dd($categoryLists);
        // $i=0;
        // foreach($categoryLists as $catlist)
        // {
        //     $nextCat = ParentCategory::where('delete_status', '0')->where('parent_id',$catlist->id)->get();
        //     $categoryLists[$i]->setAttribute('next_cat', $nextCat);  
        //     $i++;
        // }
        $categories = ParentCategory::where('parent_id','0')
            ->with('childrenCategories')
            ->get();
        dd($categories);
        
        return view('admin.form.parentcategories',compact('categoryLists'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'category_name' => 'required',
            'category_slug' => 'required|unique:tbl_parent_categories,category_slug',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $cat = new ParentCategory();

        $cat->parent_id = request('parent_id');
        $cat->category_name = request('category_name');
        $cat->category_slug = str_slug(request('category_slug'));
        $cat->image = $request->session()->get('ajaximage');
        $cat->publish_status = request('publish_status');
        $cat->meta_title = request('meta_title');
        $cat->meta_keyword = request('meta_keyword');
        $cat->meta_description = request('meta_description');

        $cat->save();

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/parentCategories')->with('success', 'Parent Category created successfully.');
    }

    public function edit(Request $request,$id)
    {
        // if ($request->session()->has('ajaximage')) {
        //     dd($request->session()->has('ajaximage'));
        // }

        $parentCategory = ParentCategory::where('id', $id)->first();
        dd($parentCategory->product);
        return view('admin.form.parentcategories', compact('parentCategory'));
    }

    public function update(Request $request, $id)
    {
        $parentCategory = ParentCategory::where('id', $id)->first();

        $this->validate(request(), [
            'parent_category_name' => 'required',
            'parent_category_slug' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $file = request()->file('image');
        if ($file != null) {
            $image = $parentCategory->image;
            @unlink('uploads/' . 'categories/' . $image);
            $data1 = ([
                'image' => $request->session()->get('ajaximage'),
            ]);
            ParentCategory::where('id', $id)->update($data1);
        }

        $data = ([
            'parent_category_name' => request('parent_category_name'),
            'parent_category_slug' => str_slug(request('parent_category_slug')),
            'publish_status' => request('publish_status'),
            'meta_title' => request('meta_title'),
            'meta_keyword' => request('meta_keyword'),
            'meta_description' => request('meta_description'),
        ]);

        ParentCategory::where('id', $id)->update($data);

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/parentCategories')->with('success', 'Parent Category updated successfully.');
    }

    public function destroy($id)
    {
        $parentCategory = ParentCategory::where('id', $id)->first();

        if (isset($parentCategory)) {
            if (count($parentCategory->subcategory) > 0) { //relationship exists?
                foreach ($parentCategory->subcategory as $item) {
                    if ($item->delete_status == 0) {
                        return redirect('/ns-admin/parentCategories')->with('error', 'Parent Category not empty.');
                    } else {
                        dd('deleted');
                        $data = ([
                            'delete_status' => '1'
                        ]);

                        ParentCategory::where('id', $id)->update($data);

                        return redirect('/ns-admin/parentCategories')->with('success', 'Parent Category deleted successfully.');
                    }
                }
            } else {
                dd('deleted');
                $data = ([
                    'delete_status' => '1'
                ]);

                ParentCategory::where('id', $id)->update($data);

                return redirect('/ns-admin/parentCategories')->with('success', 'Parent Category deleted successfully.');
            }
        }

        return redirect('/ns-admin/parentCategories')->with('error', 'Parent Category not found.');
    }
}
