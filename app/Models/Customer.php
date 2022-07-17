<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomerResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_customers';

    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'reward_point','provider_id','phone', 'address','email', 'password', 'country', 'state', 'town' , 'apartment', 'street', 'zipcode' ,'is_social_login', 'payment_option', 'email_verified_at', 'image', 'verify_otp', 'forgot_password_otp', 'publish_status', 'delete_status', 'fb_id', 'google_id'
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
        $this->notify(new CustomerResetPasswordNotification($token));
    }

    public function getProfilePercentAttribute()
    {
        return round(count(array_filter($this->attributes)) * 10);
    }

}
