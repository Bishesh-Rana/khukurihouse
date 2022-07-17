<?php

namespace App\QueryFilters;

use Closure;

class Price
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
        $direction = in_array(request('direction'), ['asc', 'desc']) ? request('direction') : 'asc';
        if ($test = array_search(request('sortBy'), $this->lookupTable())) {
            $query->orderBy($test, $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $next($query);
    }

    private function lookupTable(): array
    {
        return [
            'product_name' => 'name',
            'created_at' => 'date',
            'product_original_price' => 'price',
            'view_count' => 'popularity'
        ];
    }
}
