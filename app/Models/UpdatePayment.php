<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdatePayment extends Model
{
    protected $table = "tbl_update_payments";
    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany('App\UpdateOrder','id','id','ref_id');
    }
}
