<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "tbl_notifications";

    protected $fillable = ['ref_id', 'customer_id', 'customer_email','type','title','description','extra_data','slug','seen_status'];
}
