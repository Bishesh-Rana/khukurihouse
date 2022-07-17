<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateOrder extends Model
{
    protected $table = "tbl_update_orders";

    protected $guarded = [];


    public function payment()
    {
        return $this->belongsTo('App\UpdatePayment','ref_id','id');
    }
}
