<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    protected $table = "tbl_statements";

    protected $guarded = [];

    public function getCommissionFeeAttribute()
    {
        return 'commission_fee';
    }

    public function getSellerNameAttribute()
    {
        return Seller::where('id',$this->seller_id)->first()->company_name;
    }
}
