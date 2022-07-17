<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ManageProductTrait;

class ManageProductImageController extends Controller
{
    use ManageProductTrait;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function manageProductImagesList(){

    $products = Product::where('delete_status', '0')
    ->where('tbl_products.owner_id', 0) // 0 for admin
    ->get();

    foreach($products as $key => $row){
        $images = Photo::where('delete_status', '0')
        ->where('imageable_id', $row->id)
        ->where('imageable_type', 'App\Product')
        ->get();
        $row->setAttribute('images', $images);
    }

    return view('admin.list.manageproduct_image', compact('products'));

    }

    public function AjaxImageUpload(Request $request){
        $formImage = "image";
        $files = $request->file('image');
        $this->imageUpload($request, $files, 'product', 'products', $formImage);
    }

    public function singleImgDestroy($id){
        $data = ([
            'delete_status' => '1'
        ]);

        Photo::where('id', $id)->update($data);
        return back()->with('success', 'Image Deleted Successfully !!!');
    }
}
