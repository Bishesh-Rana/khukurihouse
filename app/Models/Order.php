<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "tbl_orders";

    protected $fillable = ['aff_id','ref_id','product_id','quantity', 'discount_amount'];

    public function payment()
    {
        return $this->belongsTo('App\Payment','ref_id','ref_id');
    }

    public function getProductNameCustomerAttribute()
    {
        return Product::where('id',$this->product_id)->first()->product_name;
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
