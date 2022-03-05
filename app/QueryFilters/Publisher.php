<?php

namespace App\QueryFilters;

class Publisher
{
    public function handle($query, $next)
    {
        if (request()->has('publisher')) {
            return $next($query)->where('publisher',request('publisher')); 
        }

        return $next($query);     
    }
}