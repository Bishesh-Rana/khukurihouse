<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "tbl_photos";
    protected $fillable = ['image', 'imageable_id', 'imageable_type'];
    public function imageable(){
        return $this->morphTo();
    }
}
