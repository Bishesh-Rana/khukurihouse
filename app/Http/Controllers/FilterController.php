<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\ArrayOfCategoryTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class FilterController extends Controller
{
    use ArrayOfCategoryTrait;

    public function categoryFilter(Request $request)
    {
        $searchCategory = $request->searchCategory;
        $searchPrice = $request->searchPrice;
        $searchSeller = $request->searchSeller;
        $category_slug = $request->categoryUrl;

        ($request->showCount) ? $pagination = $request->showCount : $pagination = 20; //Default Pagination

        $finalArray = $this->getArrayOfCategory($category_slug);

        $filter = explode("_", $request->sortBy)[0];
        $ascOrDesc = explode("_", request('sortBy'))[1];

        $categoryProducts = Product::allStatus()
            ->holidayStatus()
            ->whereIn('tbl_products.category_id', $finalArray)
            ->when($searchCategory, function ($query, $searchCategory) {
                return $query->whereIn('tbl_products.category_id', $searchCategory);
            })
            ->when($searchPrice, function ($query, $searchPrice) {
                $minPrice = Str::before(Str::after(explode("-", $searchPrice)[0], "Rs."), " ");
                (!is_numeric($minPrice)) ? $minPrice = 0 : ''; //checking if the value is a number
                $maxPrice = Str::before(Str::after(explode("-", $searchPrice)[1], "Rs."), " ");
                (!is_numeric($maxPrice)) ? $maxPrice = 0 : ''; //checking if the value is a number
                return $query->whereBetween('tbl_products.product_original_price', [$minPrice, $maxPrice]);
            })
            ->when($searchSeller, function ($query, $searchSeller) {
                return $query->whereIn('tbl_products.owner_id', $searchSeller);
            })
            ->when($filter == "price", function ($query) use ($ascOrDesc) {
                return $query->orderBy('tbl_products.product_original_price', $ascOrDesc);
            })
            ->when($filter == "date", function ($query) use ($ascOrDesc) {
                return $query->orderBy('tbl_products.created_at', $ascOrDesc);
            })
            ->when($filter == "rating", function ($query)  use ($ascOrDesc) {
                return $query->get()->sortByDesc('avg_rating');
            })
            ->when($filter == "popularity", function ($query) use ($ascOrDesc) {
                return $query->orderBy('tbl_products.view_count', $ascOrDesc);
            })
            ->paginate($pagination);


        return view('website.ajaxlist.category', compact('categoryProducts'));
    }

    public function sellerFilter(Request $request)
    {
        $searchCategory = $request->searchCategory;
        $searchPrice = $request->searchPrice;
        $sellerId = $request->sellerId;

        ($request->showCount) ? $pagination = $request->showCount : $pagination = 20; //Default Pagination

        $filter = explode("_", $request->sortBy)[0];
        $ascOrDesc = explode("_", request('sortBy'))[1];

        $sellerProducts = Product::allStatus()
            ->holidayStatus()
            ->where('tbl_products.owner_id', $sellerId)
            ->when($searchCategory, function ($query, $searchCategory) {
                $finalArray = $this->getArrayOfCategoryFromArrayOfCategory($searchCategory);
                return $query->whereIn('tbl_products.category_id', $finalArray);
            })
            ->when($searchPrice, function ($query, $searchPrice) {
                $minPrice = Str::before(Str::after(explode("-", $searchPrice)[0], "Rs."), " ");
                (!is_numeric($minPrice)) ? $minPrice = 0 : ''; //checking if the value is a number
                $maxPrice = Str::before(Str::after(explode("-", $searchPrice)[1], "Rs."), " ");
                (!is_numeric($maxPrice)) ? $maxPrice = 0 : ''; //checking if the value is a number
                return $query->whereBetween('tbl_products.product_original_price', [$minPrice, $maxPrice]);
            })
            ->when($filter == "price", function ($query) use ($ascOrDesc) {
                return $query->orderBy('tbl_products.product_original_price', $ascOrDesc);
            })
            ->when($filter == "date", function ($query) use ($ascOrDesc) {
                return $query->orderBy('tbl_products.created_at', $ascOrDesc);
            })
            ->when($filter == "rating", function ($query)  use ($ascOrDesc) {
                // return $query->whereHas('reviews', function (Builder $query) use ($ascOrDesc) {
                //     $query->orderByRaw('AVG(rating)', $ascOrDesc);
                // });
                return $query->get()->sortByDesc('avg_rating');
            })
            ->when($filter == "popularity", function ($query) use ($ascOrDesc) {
                return $query->orderBy('tbl_products.view_count', $ascOrDesc);
            })
            ->paginate($pagination);

        // dd($sellerProducts);

        return view('website.ajaxlist.seller', compact('sellerProducts'));
    }
}
