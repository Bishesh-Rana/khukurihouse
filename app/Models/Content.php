<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = "tbl_contents";

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function statusProducts()
    {
        return $this->products()->allStatus()->holidayStatus();
    }
    public function child(){
        return $this->hasMany(Content::class,'parent_id');
    }
}
