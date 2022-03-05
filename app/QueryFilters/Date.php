<?php

namespace App\QueryFilters;

class Date
{
    public function handle($query, $next)
    {
        if (request()->has('release_date')) {
            $q = request('release_date');
            return $next($query)->where('release_date', 'like', '%'.$q.'%'); 
        }

        return $next($query);     
    }
}