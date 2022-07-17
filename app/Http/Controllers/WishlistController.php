<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function show()
    {
        $setting = Setting::first();
        if ($setting != null) {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
            $meta_keyword = $setting->meta_keyword;
        } else {
            $meta_title = '';
            $meta_description = '';
            $meta_keyword = '';
        }

        if (Auth::guard('web')->check()) {
            $wishlist_products = Auth::guard('web')->user()->wishlist;
            // $wishlist_products = new Collection();
            // foreach ($customer->wishlist as $product) {
            //     $wishlist_products = $wishlist_products->push(Product::findorFail($product->id));
            // }
            // dd($wishlist_products);
            return view('website.wishlist', compact('wishlist_products', 'meta_title', 'meta_description', 'meta_keyword'));
        }
        return redirect()->intended(route('customer.login'))->with('status', 'Please Login to continue');
    }
    public function add($id)
    {
        if (Auth::guard('web')->check()) {
            $customer = Auth::guard('web')->user();
            foreach ($customer->wishlist as $item) //checking whether the item already exist in the user's wishlist
            {
                if ($item->pivot->product_id == $id) {
                    return back()->with('error', 'Item already in your wishlist');
                }
            }
            $customer->wishlist()->attach($id);
            return back()->with('success', 'Item added to your wishlist');
        } else {
            // request()->session()->put('error', 'Please Login to continue');
            return redirect()->intended(route('customer.login'))->with('error-message', 'Please login to continue');
        }
    }

    public function remove($id)
    {
        $customer = Auth::guard('web')->user();
        $customer->wishlist()->detach($id);
        return back()->with('success', 'Item removed from wishlist');
    }
}
