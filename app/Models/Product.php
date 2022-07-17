<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $table = "tbl_products";
    const DELIVERYTYPE = [
        'express', 'free', 'standard'
    ];

    protected $guarded = [];

    public function photos()
    {
        return $this->hasMany(Photo::class, 'imageable_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function contents()
    {
        return $this->belongsToMany(Content::class)->withTimestamps();
    }

    public function wishlist()
    {
        return $this->belongsToMany(Customer::class, 'tbl_wishlists')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'owner_id');
    }

    //Accessors
    public function getAvgRatingAttribute()
    {
        if (count($this->reviews) > 0)
            return round($this->reviews->sum('rating') / count($this->reviews), 2);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rs. ' . number_format($this->product_original_price);
    }

    public function getCategoryNameAttribute()
    {
        return Category::where('id', $this->category_id)->first()->category_name;
    }

    public function getSellerNameAttribute()
    {
        if ($this->owner_id == 0) {
            return "Admin";
        } else {
            return Seller::where('id', $this->owner_id)->first()->seller_code;
        }
    }

    public function scopeAllStatus($query)
    {
        return $query->where('tbl_products.publish_status', '1')
            ->where('tbl_products.delete_status', '0')
            // ->where('tbl_products.live_status', '1')
            ->whereHas('stock', function (Builder $query) {
                $query->where('remaining_stock', '>', '0');
            });
    }

    public function scopeHolidayStatus($query)
    {
        return $query->whereHas('seller', function (Builder $query) {
            $query->where('holiday_mode', '0');
        });
    }
    public function flash()
    {
        return $this->hasOne(FlashSale::class);
    }
}
