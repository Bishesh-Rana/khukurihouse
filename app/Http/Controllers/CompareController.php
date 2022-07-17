<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Compare;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $oldCompared = Session::has('compared') ? Session::get('compared') : null;

        if(isset($oldCompared))
        {
            if(count($oldCompared->items) >= 5)
            {
                return back()->with('compare-error','You have reached the maximum amount of products in your compare list.');
            }
        }
        $compared = new Compare($oldCompared);
        $compared->add($product, $product->id);
        $request->session()->put('compared', $compared);
        return back()->with('success','Item added to compare list.');
    }

    public function remove(Request $request, $id)
    {
        $oldCompare = Session::has('compared') ? Session::get('compared') : null;
        $compared = new Compare($oldCompare);
        $compared->removeItem($id);
        if (count($compared->items) > 0)
        {
            Session::put('compared', $compared);
        }
        else
        {
            Session::forget('compared');
        }
        return back()->with('success','Item removed from compare list.');
    }

    public function show(Request $request)
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

        $oldCompare = Session::get('compared');
        $compared = new Compare($oldCompare);
        $compared_products = $compared->items;

        return view('website.compare', compact('compared', 'compared_products', 'meta_title', 'meta_description', 'meta_keyword'));
    }
}
