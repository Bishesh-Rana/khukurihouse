<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryServiceArea extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function districts()
    {
        return $this->belongsToMany(
            District::class,
           'delivery_service_area_districts',
           'area_id',
           'district_id','id','dist_id'
        );
    }
}
