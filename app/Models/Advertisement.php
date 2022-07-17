<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = "tbl_advertisements";
    protected $casts = [
        'featured' => 'bool',
        'publish_status' => 'bool',
    ];

    public function getApiImageAttribute()
    {
        return $this->image ? asset("uploads/notices/" . $this->image) : '';
    }
}
