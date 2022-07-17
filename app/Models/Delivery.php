<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\DeliveryResetPasswordNotification;

class Delivery extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $table = 'tbl_deliveries';
    protected $guard = 'delivery';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
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

    public function delivery()
    {
        return $this->belongsTo('App\Delivery', 'parent_id');
    }

    // mutators for delivery information
    public function getDeliveryProfileInformationAttribute()
    {
        return count(array_filter($this->attributes));
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DeliveryResetPasswordNotification($token));
    }
}
