<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerAddProductNotification extends Model
{
    protected $table = 'tbl_seller_add_productnotifications';

    protected $fillable = ['product_id', 'seller_id', 'seen_status', 'created_at', 'updated_at'];

}
