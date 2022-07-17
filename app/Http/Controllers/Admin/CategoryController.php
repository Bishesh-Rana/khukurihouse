<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\ArrayOfCategoryTrait;
use App\Http\Traits\ImageTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use ImageTrait;
    use ArrayOfCategoryTrait;

    protected $category;

    private $selectCategoryId = 0;

    public function __construct(Category $category)
    {
        $this->middleware('auth:admin');
        $this->category = $category;
    }

    private function checkParentChildRelation($category, $checkId)
    {
        $finalArray = $this->getArrayOfCategory($category->category_slug);
        foreach ($finalArray as $arr) {
            if ($arr == $checkId) {
                return "failure";
            }
        }
        return "success";
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "image";
        $files = $request->file('image');
        $this->imageUpload($request, $files, 'parent-category', 'categories', $formImage);
    }

    public function categoryTree($parent_id = 0, $sub_mark = '', $htmlOption = null)
    {
        $categories = Category::where('category_id', $parent_id)->where('delete_status', '0')->where('publish_status', '1')->get();
        if (count($categories) > 0) {
            $tes = "";
            foreach ($categories as $row) {
                if ($row->id == $this->selectCategoryId) {
                    $tes = " selected";
                } else {
                    $tes = "";
                }
                $htmlOption .= '<option value="' . $row->id . '"' . $tes . '>' . $sub_mark . $row->category_name . '</option>';
                $htmlOption .= $this->categoryTree($row->id, $sub_mark . '&nbsp&nbsp&nbsp&nbsp');
            }
        }
        return  $htmlOption;
    }

    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'categories/' . $image);
        }
        $categories = Category::where('delete_status', '0')->orderBy('position','asc')->paginate(10);

        $z = 0;
        foreach ($categories as $row) {
            $parent_content = Category::where('publish_status', '1')->where('delete_status', '0')->where('id', $row->category_id)->first();
            if ($parent_content == null) {
                $categories[$z]->setAttribute('parent_category', "Root");
            } else {
                $categories[$z]->setAttribute('parent_category', $parent_content->category_name);
            }
            $z++;
        }
        return view('admin.list.category', compact('categories'));
    }

    public function fetch(Request  $request)
    {
        $categoryName = $request->categoryName;
        $parentCategoryName = $request->parentCategoryName;

        $categories = Category::where('delete_status', '0')
            ->when($categoryName, function ($query, $categoryName) {
                return $query->where("category_name", "LIKE", "%$categoryName%");
            })
            ->when($parentCategoryName, function ($query, $parentCategoryName) {
                $category_list = Category::where('tbl_categories.category_name', "LIKE", "%$parentCategoryName%")->get();
                $arr = [];
                foreach ($category_list as $data) {
                    array_push($arr, $data->id);
                }
                return $query->whereIn('tbl_categories.category_id', $arr);
            })
            ->paginate(10);

        $z = 0;
        foreach ($categories as $row) {
            $parent_content = Category::where('publish_status', '1')->where('delete_status', '0')->where('id', $row->category_id)->first();
            if ($parent_content == null) {
                $categories[$z]->setAttribute('parent_category', "Root");
            } else {
                $categories[$z]->setAttribute('parent_category', $parent_content->category_name);
            }
            $z++;
        }
        return view('admin.list.ajaxlist.category', compact('categories'));
    }

    public function view($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.pages.category', compact('category'));
    }

    public function create()
    {
        $categories = Category::where('category_id', '0')->with('child')->get();
        $htmlOption = $this->categoryTree();

        return view('admin.form.category', compact('categories', 'htmlOption'));
    }

    public function list(){
        $categories = Category::where('category_id', 0)->orderBy('position', 'asc')->with('child')->get();
        return view('admin.pages.list', compact('categories'));
    }
    public function postlist(Request $request){
        parse_str($request->sort, $arr);
        $order = 1;
        if (isset($arr['menuItem'])) {
            foreach ($arr['menuItem'] as $key => $value) {  //id //parent_id
                $this->category->where('id', $key)
                    ->update([
                        'position' => $order,
                        'category_id' => ($value == 0) ? 0 : $value,
                        // 'main_child' => ($value == "null") ? 0 : 1,
                    ]);
                $order++;
            }
        }

        return true;
    }
    private function update_child($id)
    {
        $categories = Category::where('category_id', $id)->get();
        if ($categories->count() > 1) {
            foreach ($categories as $child) {
                Category::where('id', $child->id)->update(['category_id' => $child->id]);
                $this->update_child($child->id);
            }
            // $this->forgetMenuCache();
        }
    }

    // public function categoryTree($parent_id = 0,$sub_mark = '',$htmlOption = null)
    // {
    //     $categories = Category::where('category_id',$parent_id)->get();
    //     if(count($categories) > 0)
    //         {
    //             foreach($categories as $row){
    //                 $htmlOption .= '<option'.' value="'.$row->id.'">'.$sub_mark.$row->category_name.'</option>';
    //                 $htmlOption .=$this->categoryTree($row->id,$sub_mark.'&nbsp&nbsp&nbsp&nbsp');
    //             }
    //         }
    //         return  $htmlOption;
    // }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'category_name' => 'required',
            'category_slug' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $cat = new Category();

        $cat->category_id = request('category_id');
        $cat->position = request('position');
        $cat->category_name = request('category_name');
        $cat->category_slug = Str::slug(request('category_slug'));
        $cat->image = $request->session()->get('ajaximage');
        $cat->alt = request('alt');
        $cat->featured = request('featured');
        $cat->show_on_home = request('show_on_home');

        $cat->hot_best_sellers = request('hot_best_sellers');
        $cat->hot_new_arrivals = request('hot_new_arrivals');
        $cat->publish_status = request('publish_status');
        $cat->meta_title = request('meta_title');
        $cat->meta_keyword = request('meta_keyword');
        $cat->meta_description = request('meta_description');

        //Removing all placements.
        $placement = Category::where('placement', request('placement'))->first();
        if ($placement) {
            Category::where('placement', request('placement'))->update(['placement' => 'none']);
        }
        $cat->placement = request('placement');

        $file = request()->file('banner_image');

        if ($file != null) {
            $img_name = 'banner-category-' . time() . '.' . $file->clientExtension();

            $img = Image::make($file);

            $img->save('uploads/categories/' . $img_name);

            $cat->banner_image = $img_name;
        }

        $file1 = request()->file('category_icon');

        if ($file1 != null) {
            $img_name = 'category-icon-' . time() . '.' . $file1->clientExtension();

            $img = Image::make($file1);

            $img->save('uploads/categories/' . $img_name);

            $cat->category_icon = $img_name;
        }

        $cat->save();

        $request->session()->forget('ajaximage');

        return redirect('/ns-admin/categories')->with('success', 'Category created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $selectCategory = Category::where('id', $id)->first();
        $this->selectCategoryId = $selectCategory->category_id;
        $htmlOption = $this->categoryTree();

        return view('admin.form.category', compact('selectCategory', 'htmlOption'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('id', $id)->first();

        $checkId = $request->category_id; //to check parent child relation

        $manualValidation = $this->checkParentChildRelation($category, $checkId);

        if ($manualValidation == "success") {

            $this->validate(request(), [
                'category_name' => 'required',
                'category_slug' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
            ]);

            $data = ([
                'category_id' => request('category_id'),
                'position' => request('position'),
                'category_name' => request('category_name'),
                'category_slug' => Str::slug(request('category_slug')),
                'featured' => request('featured'),
                'show_on_home' => request('show_on_home'),
                'placement' => request('placement'),
                'hot_best_sellers' => request('hot_best_sellers'),
                'hot_new_arrivals' => request('hot_new_arrivals'),
                'publish_status' => request('publish_status'),
                'meta_title' => request('meta_title'),
                'meta_keyword' => request('meta_keyword'),
                'meta_description' => request('meta_description'),
                'alt' => request('alt')
            ]);
            $file = request()->file('image');
            if ($file != null) {
                $image = $category->image;
                @unlink('uploads/categories/' . $image);
                $data1 = ([
                    'image' => $request->session()->get('ajaximage'),
                ]);
                Category::where('id', $id)->update($data1);
            }

            $file = request()->file('banner_image');

            if ($file != null) {
                //For deleting previous image
                $image = $category->banner_image;
                @unlink('uploads/categories/' . $image);

                $img_name = 'banner-category-' . time() . '.' . $file->clientExtension();
                $img = Image::make($file);
                $img->save('uploads/categories/' . $img_name);

                $data2 = (['banner_image' => $img_name]);

                Category::where('id', $id)->update($data2);
            }

            $file1 = request()->file('category_icon');

            if ($file1 != null) {
                $image = $category->category_icon;
                @unlink('uploads/categories/' . $image);

                $img_name = 'category-icon-' . time() . '.' . $file1->clientExtension();
                $img = Image::make($file1);
                $img->save('uploads/categories/' . $img_name);

                $data3 = (['category_icon' => $img_name]);

                Category::where('id', $id)->update($data3);
            }

            $placement = Category::where('placement', request('placement'))->first();
            if ($placement) {
                Category::where('placement', request('placement'))->update(['placement' => 'none']);
            }

            Category::where('id', $id)->update($data);

            $request->session()->forget('ajaximage');

            return redirect('/ns-admin/categories')->with('success', 'Category updated successfully.');
        } else {
            return back()->with('error', 'Parent Category cannot be move inside child category, first move child category to other category or root category.');
        }
    }

    public function destroy($id)
    {
        $category = Category::where('id', $id)->first();

        if (isset($category)) {
            if (count($category->child) > 0) { //child category exists?
                foreach ($category->child as $child) {
                    if ($child->delete_status == 0) {
                        return redirect('/ns-admin/categories')->with('error', 'Delete Child Categories First!');
                    } else {
                        $data = ([
                            'delete_status' => '1'
                        ]);
                        Category::where('id', $id)->update($data);
                        return redirect('/ns-admin/categories')->with('success', 'Category deleted successfully.');
                    }
                }
            } elseif (count($category->products) > 0) { //product exists?
                foreach ($category->products as $product) {
                    if ($product->delete_status == 0) {
                        return redirect('/ns-admin/categories')->with('error', 'Delete Associated Products First!');
                    } else {
                        $data = ([
                            'delete_status' => '1'
                        ]);
                        Category::where('id', $id)->update($data);
                        return redirect('/ns-admin/categories')->with('success', 'Category deleted successfully.');
                    }
                }
            } else {
                $data = ([
                    'delete_status' => '1'
                ]);
                Category::where('id', $id)->update($data);
                return redirect('/ns-admin/categories')->with('success', 'Category deleted successfully.');
            }
        }

        return redirect('/ns-admin/categories')->with('error', 'Category not found.');
    }

    public function removeImage($image)
    {
        $photo = Category::where('image', $image)->first();

        if (isset($photo)) {
            $image = $photo->image;
            @unlink('uploads/categories/' . $image);

            $data2 = (['image' => null]);
            Category::where('image', $image)->update($data2);
            return back()->with('success', 'Product Image Deleted Successfully');
        }
        return back()->with('error', 'Product Image deletion failed');
    }

    public function removeBanner($image)
    {
        $photo = Category::where('banner_image', $image)->first();

        if (isset($photo)) {
            $image = $photo->banner_image;
            @unlink('uploads/categories/' . $image);

            $data2 = (['banner_image' => null]);
            Category::where('banner_image', $image)->update($data2);
            return back()->with('success', 'Banner Image Deleted Successfully');
        }
        return back()->with('error', 'Banner Image deletion failed.');
    }
    public function updateOrder(Request $request)
    {
        $categories = Category::all();
        foreach ($categories as $content) {
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
