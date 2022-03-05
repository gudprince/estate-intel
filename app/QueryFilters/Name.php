<?php

namespace App\QueryFilters;

class Name
{
    public function handle($query, $next)
    {
        if (request()->has('name')) {
            return $next($query)->where('name',request('name')); 
        }

        return $next($query);     
    }
}