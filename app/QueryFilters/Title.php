<?php

namespace App\QueryFilters;

class Title
{
    public function handle($query, $next)
    {
        if (request()->has('title')) {
            $title = request('title');
            return $next($query)->where('title','LIKE', "%{$title}%");
         
        }

        return $next($query);     
    }
}