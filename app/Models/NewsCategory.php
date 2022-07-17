<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = "tbl_news_categories";

    public function news()
    {
        return $this->belongsToMany(News::class)->withTimestamps();
    }
}
