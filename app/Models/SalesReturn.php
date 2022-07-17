<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesReturn extends Model
{
    protected $table = "tbl_sales_returns";

    public function getSellerNameAttribute()
    {
        return Seller::where('id',$this->seller_id)->first()->company_name;
    }

    public function getProductNameAttribute()
    {
        return Product::where('id',$this->product_id)->first()->product_name;
    }
}
