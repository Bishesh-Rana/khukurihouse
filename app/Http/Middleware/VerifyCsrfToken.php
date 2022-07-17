<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $addHttpCookie = true;

    protected $except = [
        //
        'https://eshoppingnepal.com/ns-admin/product/getsubcategory',
        'https://eshoppingnepal.com/ns-admin/product/getchildcategory',
        'https://eshoppingnepal.com/payment/verification',
        'https://eshoppingnepal.com/payment/success',
        'https://eshoppingnepal.com/beta/public/payment/success'
    ];
}
