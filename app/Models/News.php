<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "tbl_news";

    protected $dates = [
        'created_at',
        'updated_at',
        'news_date'
    ];

    public function newsCategory()
    {
        return $this->belongsToMany(NewsCategory::class)->withTimestamps();
    }

    public function writer()
    {
        return $this->belongsToMany(Writer::class)->withTimestamps();
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
