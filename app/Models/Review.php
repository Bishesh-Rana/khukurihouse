<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "tbl_reviews";

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function customer(){
        return $this->belongsTo('App\Models\Customer');

    }
}
