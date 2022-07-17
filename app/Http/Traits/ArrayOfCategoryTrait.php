<?php

namespace App\Http\Traits;

use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Models\Product;

trait ArrayOfCategoryTrait
{
    public function getArrayOfCategory($category_slug)
    {
        $category = Category::where('category_slug',$category_slug)->get();

        $category_tree = collect(CategoryResource::collection($category));

        $flattened = $category_tree->flatten();

        return $flattened->all();
    }

    public function getArrayOfCategoryFromArrayOfCategory($category_id)
    {
        $category = Category::whereIn('id',$category_id)->get();

        $category_tree = collect(CategoryResource::collection($category));

        $flattened = $category_tree->flatten();

        return $flattened->all();
    }

    public function getChildProducts($category_slug)
    {
        $category = Category::where('category_slug',$category_slug)->get();

        $category_tree = collect(CategoryResource::collection($category));

        $flattened = $category_tree->flatten()->all();

        $products = Product::allStatus()->holidayStatus()->whereIn('category_id',$flattened)->get();

        return $products;

    }
}
