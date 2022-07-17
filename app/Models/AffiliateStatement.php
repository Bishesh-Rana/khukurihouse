<?php

namespace App\Models;

use App\Models\Affiliate;
use Illuminate\Database\Eloquent\Model;

class AffiliateStatement extends Model
{
    protected $table = 'tbl_affiliate_statements';
    protected $guarded = [];

    public function getAffiliateNameAttribute()
    {
        return Affiliate::where('affiliate_code',$this->affiliate_id)->first()->first_name;
    }
}
