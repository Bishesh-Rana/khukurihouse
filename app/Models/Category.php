<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Category as CategoryResource;

class Category extends Model
{
    protected $table = 'tbl_categories';
    protected $guarded = [];

    // public function categories()
    // {
    //     return $this->hasMany(Category::class);
    // }

    // public function childrenCategories()
    // {
    //     return $this->hasMany(Category::class)->with('categories');
    // }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function child()
    {
        $child_cate = $this->hasMany(Category::class, 'category_id');
        return $child_cate->orderBy('position', 'asc');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    //Query Scopes
    public function scopeStatus($query)
    {
        return $query->where('publish_status', '1')->where('delete_status', '0');
    }

    public function statusProducts()
    {
        return $this->products()->allStatus()->holidayStatus();
    }

    public function getParentCategoryAttribute()
    {
        if ($this->category_id == 0) {
            return "Root";
        } else {
            return Category::where('id', $this->category_id)->first()->category_name;
        }
    }

    public function getChildProducts($limit = null)
    {
        $category = Category::where('category_slug', $this->category_slug)->get();
        $category_tree = collect(CategoryResource::collection($category));

        $flattened = $category_tree->flatten()->all();
        if ($limit) {
            $products = Product::allStatus()->whereIn('category_id', $flattened)->limit($limit)->get();
        } else {
            $products = Product::allStatus()->whereIn('category_id', $flattened)->get();
        }

        return $products;
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_id')
            ->with('child');
    }

    public function scopeHome($query)
    {
        return $query->where('publish_status', '1')->where('delete_status', '0')->where('show_on_home', '1');
    }
}
