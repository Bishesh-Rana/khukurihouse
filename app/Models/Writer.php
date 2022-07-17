<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    protected $table = "tbl_writers";

    public function news()
    {
        return $this->belongsToMany(News::class)->withTimestamps();
    }
}
