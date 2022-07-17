<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "tbl_payments";

    public function orders()
    {
        return $this->hasMany('App\Order','ref_id','ref_id');
    }

    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }
}
