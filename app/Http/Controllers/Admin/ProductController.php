<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Models\Photo;
use App\Models\Stock;
use App\Models\Content;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use App\Http\Traits\ImageTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\SellerAddProductNotification;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ImageTrait;

    private $category_tree = "";

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AjaxImageUpload(Request $request)
    {
        $formImage = "image";
        $files = $request->file('image');
        $this->imageUpload($request, $files, 'product', 'products', $formImage);
    }

    public function notificationUpdated($product_id)
    {
        SellerAddProductNotification::where('product_id', $product_id)->update(["seen_status" => "1"]);

        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);

        return view('admin.list.products', compact('products'));
    }
    public function index(Request $request)
    {
        if ($request->session()->has('ajaximage')) {
            $image = $request->session()->get('ajaximage');
            @unlink('uploads/' . 'products/' . $image);
        }

        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->where('tbl_products.delete_status', '0')
            // ->where('tbl_products.publish_status', '1')
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);


        return view('admin.list.products', compact('products'));
    }

    public function allProductFetch(Request $request)
    {
        $productName = $request->productName;
        $productOwnerCode = $request->productOwnerCode;
        $productCategory = $request->productCategory;

        $products = Product::leftJoin('tbl_sellers', 'tbl_sellers.id', '=', 'tbl_products.owner_id')
            ->where('tbl_products.delete_status', '0')
            ->where('tbl_products.publish_status', '1')
            ->when($productName, function ($query, $productName) {
                return $query->where('tbl_products.product_name', "LIKE", "%$productName%");
            })

            ->when($productOwnerCode, function ($query, $productOwnerCode) {
                return $query->where('tbl_sellers.seller_code', "LIKE", "%$productOwnerCode%");
            })

            ->when($productCategory, function ($query, $productCategory) {
                $category_list = Category::where('tbl_categories.category_name', "LIKE", "%$productCategory%")->get();
                $arr = [];
                foreach ($category_list as $data) {
                    array_push($arr, $data->id);
                }

                return $query->whereIn('tbl_products.category_id', $arr);
            })
            ->select('tbl_products.*', 'tbl_sellers.seller_code')
            ->orderBy('tbl_products.id', 'desc')
            ->paginate(10);
        return view('admin.list.ajaxproduct.product', compact('products'))->render();
    }

    public function create()
    {
        $categories = Category::where('publish_status', '1')->where('delete_status', '0')->where('category_id', '0')->get();
        $contents = Content::where('publish_status', '1')->where('delete_status', '0')->get();
        $measures = Measure::where('publish_status', '1')->where('delete_status', '0')->get();
        $deliveryType = $this->getDeliveryType();

        return view('admin.form.products', compact('categories', 'contents', 'measures', 'deliveryType'));
    }

    public function view($id)
    {
        $product = Product::where('id', $id)->first();

        return view('admin.pages.product', compact('product'));
    }

    // public function store(Request $request)
    public function store(ProductRequest $request)
    {
        //Deal End Date can't be null
        if ($request->on_deal == "1") {
            $this->validate(request(), [
                'deal_end_date' => 'required'
            ]);
        }

        DB::beginTransaction();
        try {
            $product = new Product();
            $product->product_name = request('product_name');
            $product->owner_id = '0';
            $product->category_id = request('sub_child_category_id');
            $product->product_code = request('product_code');
            $product->product_sku = request('product_sku');
            $product->product_brand = request('product_brand');
            $product->product_model = request('product_model');
            $product->product_original_price = request('product_original_price');
            $product->product_compare_price = request('product_compare_price');
            $product->product_slug = Str::slug(request('product_name'), '-') . '-' . strtolower(Str::random(4));

            $product->product_highlights = request('product_highlights');
            $product->product_description = request('product_description');
            $product->product_warranty_type = request('product_warranty_type');
            $product->product_warrenty_period = request('product_warrenty_period');
            $product->product_warrenty_policy = request('product_warrenty_policy');
            $product->product_whats_on_box = request('product_whats_on_box');
            $product->product_package_weight = request('product_package_weight');
            $product->weight_measure = request('weight_measure');
            $product->product_package_dimension = request('product_package_dimension');
            $product->product_video_url = request('product_video_url');
            // $product->home_delivery = request('home_delivery');
            // $product->delivery_charges = request('delivery_charges');
            $product->product_key_features = request('product_key_features');
            $product->deliveryType = request('deliveryType');

            //Flags
            $product->on_sale = request('on_sale');
            $product->best_rated = request('best_rated');
            $product->showOnHome = request('showOnHome');
            $product->on_deal = request('on_deal');
            $product->deal_end_date = request('deal_end_date');

            $product->meta_title = request('meta_title');
            $product->meta_keyword = request('meta_keyword');
            $product->meta_description = request('meta_description');
            $product->publish_status = request('publish_status');
            $product->live_status = request('live_status');

            //Product Verification
            $product->quality_status = request('quality_status');
            $product->quality_reject_reason = request('quality_reject_reason');
            $product->quality_control_comment = request('quality_control_comment');

            $product->policy_status = request('policy_status');
            $product->policy_reject_reason = request('policy_reject_reason');
            $product->policy_control_comment = request('policy_control_comment');
            $product->penalty_type = request('penalty_type');
            $product->cargo = request('cargo');
            $product->alt = request('alt');

            $product->image = $request->session()->get('ajaximage');

            $product->blade = request('blade');
            $product->handle = request('handle');
            $product->blade_weight = request('blade_weight');
            $product->total_weight = request('total_weight');
            $product->material = request('material');

            // dd($request->multi_image);

            $product->save();


            $photos = request()->file('multi_image');
            if ($photos != null) {
                foreach ($photos as $key => $pics) {
                    $v = Validator::make(['photo' => request()->file('multi_image')[$key]], [
                        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);
                    if ($v->fails()) {
                        return back()->withErrors($v)->withInput();
                    }

                    $photo = new Photo();
                    $image_name = "product(" . $key . ")-" . time() . "." . $pics->clientExtension();
                    // open an image file
                    $img = Image::make($pics);
                    // save image in desired format
                    $img->save('uploads/' . 'products/' . $image_name);
                    $photo->image = $image_name;
                    $photo->imageable_id = $product->id;
                    $photo->imageable_type = 'App\Product';
                    $photo->save();
                }
            }

            $request->session()->forget('ajaximage');

            $content_ids = request('content_id');
            $product->contents()->attach($content_ids);

            $stock = new Stock();
            $stock->product_id = $product->id;
            $stock->save();
            DB::commit();
            return redirect()->route('admin.stock.edit', $product->id)->with('success', 'Product created successfully. Now, Add Some Stocks.');
            // });
        } catch (Exception $e) {
            DB::rollback();
            request()->session()->flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }

        //Redirect to Stock Add Page



        // return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function categoryTree($category_id)
    {
        if ($category_id > 0) {
            $category = Category::where('id', $category_id)->first();
            $this->category_tree .= '>' . $category->category_name . '   ';
            $this->categoryTree($category->category_id);
        }
        return $this->category_tree;
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $photos = $product->photos;
        //   dd($photos);
        if (($product->category_id) > 0) {
            $category_tree = $this->categoryTree($product->category_id);
        }
        // dd($category_tree);
        $categories = Category::where('publish_status', '1')->where('delete_status', '0')->where('category_id', '0')->get();
        $contents = Content::where('publish_status', '1')->where('delete_status', '0')->get();
        $measures = Measure::where('publish_status', '1')->where('delete_status', '0')->get();
        $deliveryType = $this->getDeliveryType();

        return view('admin.form.products', compact('deliveryType', 'product', 'category_tree', 'categories', 'contents', 'measures', 'photos'));
    }

    public function update(ProductRequest $request, $id)
    {
        //Deal End Date can't be null
        if ($request->on_deal == "1") {
            $this->validate(request(), [
                'deal_end_date' => 'required'
            ]);
        }
        // dd(request('weight_measure'));
        $product = Product::where('id', $id)->first();

        // $this->validate(request(), [
        //     'product_name' => 'required',
        //     'price' => 'required',
        //     'product_slug' => 'required',
        //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        // ]);

        $file = request()->file('image');
        if ($file != null) {
            $image = $product->image;
            @unlink('uploads/' . 'products/' . $image);
            $data1 = ([
                'image' => $request->session()->get('ajaximage'),
            ]);
            Product::where('id', $id)->update($data1);
        }

        if (request('sub_child_category_id') != null) {
            $data1 = ([
                'category_id' => request('sub_child_category_id')
            ]);
            // dd($data1);

            Product::where('id', $id)->update($data1);
        }

        $data = ([
            'product_name' => request('product_name'),
            // 'owner_id' => '0',
            'deliveryType' => request('deliveryType'),
            'product_code' => Str::slug(request('product_code')),
            'product_sku' => request('product_sku'),
            'product_brand' => request('product_brand'),
            'product_model' => request('product_model'),
            'product_original_price' => request('product_original_price'),
            'product_compare_price' => request('product_compare_price'),
            'product_slug' => Str::slug(request('product_name'), '-') . '-' . strtolower(Str::random(4)),

            'product_highlights' => request('product_highlights'),
            'product_description' => request('product_description'),
            'product_warranty_type' => request('product_warranty_type'),
            'product_warrenty_period' => request('product_warrenty_period'),
            'product_warrenty_policy' => request('product_warrenty_policy'),
            'product_whats_on_box' => request('product_whats_on_box'),
            'product_package_weight' => request('product_package_weight'),
            'weight_measure' => request('weight_measure'),
            'product_package_dimension' => request('product_package_dimension'),
            'product_video_url' => request('product_video_url'),
            // 'home_delivery' => request('home_delivery'),
            // 'delivery_charges' => request('delivery_charges'),
            'product_key_features' => request('product_key_features'),

            'on_sale' => request('on_sale'),
            'best_rated' => request('best_rated'),
            'showOnHome' => request('showOnHome'),
            'on_deal' => request('on_deal'),
            'deal_end_date' => request('deal_end_date'),
            'alt' => request('alt'),

            'meta_title' => request('meta_title'),
            'meta_keyword' => request('meta_keyword'),
            'meta_description' => request('meta_description'),
            'publish_status' => request('publish_status'),
            'live_status' => request('live_status'),

            //product verification
            'quality_status' => request('quality_status'),
            'quality_reject_reason' => request('quality_reject_reason'),
            'quality_control_comment' => request('quality_control_comment'),

            'policy_status' => request('policy_status'),
            'policy_reject_reason' => request('policy_reject_reason'),
            'policy_control_comment' => request('policy_control_comment'),
            'penalty_type' => request('penalty_type'),
            'blade' => request('blade'),
            'handle' => request('handle'),
            'blade_weight' => request('blade_weight'),
            'total_weight' => request('total_weight'),
            'material' => request('material'),
            'cargo' => request('cargo'),
        ]);

        Product::where('id', $id)->update($data);

        $photos = request()->file('multi_image');
        if ($photos != null) {
            foreach ($photos as $key => $pics) {
                $v = Validator::make(['photo' => request()->file('multi_image')[$key]], [
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                if ($v->fails()) {
                    return back()->withErrors($v)->withInput();
                }

                $photo = new Photo();
                $image_name = "product(" . $key . ")-" . time() . "." . $pics->clientExtension();
                // open an image file
                $img = Image::make($pics);
                // save image in desired format
                $img->save('uploads/' . 'products/' . $image_name);
                $photo->image = $image_name;
                $photo->imageable_id = $product->id;
                $photo->imageable_type = 'App\Product';
                $photo->save();
            }
        }

        $content_ids = request('content_id');
        $product->contents()->sync($content_ids);

        $request->session()->forget('ajaximage');

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();

        if (isset($product)) {
            $data = ([
                'delete_status' => '1'
            ]);

            Product::where('id', $id)->update($data);

            return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        }

        return redirect()->route('product.index')->with('error', 'Product not found.');
    }

    public function AjaxGetSubCategory(Request $request)
    {
        $childTrial = $request->trial;
        $categoryId = $request->parent_id;

        $var_name = "name" . $categoryId;
        $subCategory = Category::where('category_id', $categoryId)->where('delete_status', '0')->where('publish_status', '1')->get();

        if (count($subCategory) == 0) {
            return response()->json([
                'status' => false,
                'message' => "Reached End"
            ], 404);
        }

        return view('admin.form.product.ajaxsubcategories', compact('subCategory', 'var_name', 'categoryId', 'childTrial'));
    }

    public function AjaxGetChildCategory(Request $request)
    {
        $sub_id = $request->sub_id;
        $subCategory = SubCategory::where('id', $sub_id)->first();
        $childCategories = $subCategory->childcategory;

        return view('admin.form.product.ajaxchildcategories', compact('childCategories'));
    }

    public function deleteSingeImage(Request $request)
    {
        $id = $request->imageId;

        $photo = Photo::where('id', $id)->first();
        // dd($photo->image);

        if ($photo != null) {
            @unlink('uploads/' . 'products/' . $photo->image);
            Photo::where('id', $id)->delete();
        }

        return response()->json([
            'status' => "success",
            'message' => "Image deleted"
        ]);
    }

    private function getDeliveryType()
    {
        return Product::DELIVERYTYPE;
    }
}
