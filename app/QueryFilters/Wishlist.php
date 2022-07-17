<?php

namespace App\QueryFilters;

use Closure;
use Illuminate\Support\Facades\Auth;

class Wishlist
{
    /**
     * Handle an incoming request.
     *
     * @param   $query
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($query, Closure $next)
    {
        if (Auth::guard('web')->user()) {
            $query->leftJoin('tbl_wishlists', function ($test) {
                $test->on('tbl_wishlists.product_id','=','tbl_products.id')
                    ->where('tbl_wishlists.user_id','=',Auth::guard('web')->id());
            })
                ->addSelect('tbl_wishlists.product_id as userWish');
        }

        return $next($query);
    }
}
