<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tbl_tags";

    public function news()
    {
        return $this->belongsToMany(News::class)->withTimestamps();
    }
}
