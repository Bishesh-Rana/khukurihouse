<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;
    protected $fillable = [
        'startTime',
        'endTime',
        'discount',
        'productId',
        'totalStock',
        'soldStock',
    ];
    protected $casts = [
        'startTime' => 'datetime',
        'endTime' => 'datetime'
    ];
    public function getRemainingStockAttribute()
    {
        return $this->totalStock - $this->soldStock;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
