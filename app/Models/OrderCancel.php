<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCancel extends Model
{
    protected $table = 'tbl_order_cancels';

    protected $fillable = ['ref_id','reason'];
}
