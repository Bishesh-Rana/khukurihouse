<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\SellerResetPasswordNotification;

class Seller extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $table = 'tbl_sellers';
    protected $guard = 'seller';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'publish_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SellerResetPasswordNotification($token));
    }

    public function seller()
    {
        return $this->belongsTo('App\Models\Seller', 'parent_id');
    }

    // mutators for seller information
    public function getSellerProfileInformationAttribute()
    {
        return count(array_filter($this->attributes));
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\TransactionOverview', 'seller_id');
    }

    public function scopeParentSeller($query)
    {
        return $query
            ->where('publish_status', '1')
            ->where('delete_status', '0')
            ->where('parent_id', null)
            ->orWhere('parent_id', '0');
    }
}
