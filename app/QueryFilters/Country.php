<?php

namespace App\QueryFilters;

class Country
{
    public function handle($query, $next)
    {
        if (request()->has('country')) {
            return $next($query)->where('country',request('country')); 
        }

        return $next($query);     
    }
}